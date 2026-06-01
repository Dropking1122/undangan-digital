#!/bin/bash
set -e

# ─── Start MySQL ───────────────────────────────────────────────────────────────
MYSQL_DATA=/home/runner/.mysql/data
MYSQL_SOCK=/home/runner/.mysql/mysql.sock
MYSQL_PID=/home/runner/.mysql/mysql.pid
MYSQL_LOGS=/home/runner/.mysql/logs

mkdir -p "$MYSQL_DATA" "$MYSQL_LOGS"

if [ ! -d "$MYSQL_DATA/mysql" ]; then
  echo "→ Initializing MySQL data directory..."
  mysqld --initialize-insecure \
    --user="$(whoami)" \
    --datadir="$MYSQL_DATA" 2>>"$MYSQL_LOGS/error.log"
fi

if ! mysqladmin --socket="$MYSQL_SOCK" ping --silent 2>/dev/null; then
  echo "→ Starting MySQL..."
  mysqld \
    --datadir="$MYSQL_DATA" \
    --socket="$MYSQL_SOCK" \
    --pid-file="$MYSQL_PID" \
    --log-error="$MYSQL_LOGS/error.log" \
    --port=3306 \
    --bind-address=127.0.0.1 \
    --user="$(whoami)" \
    --daemonize=ON

  # Wait for MySQL to be ready
  for i in $(seq 1 20); do
    if mysql -h 127.0.0.1 -P 3306 -u root -e "SELECT 1" >/dev/null 2>&1; then
      break
    fi
    sleep 1
  done

  # Bootstrap database & user
  mysql -h 127.0.0.1 -P 3306 -u root -e "
    CREATE DATABASE IF NOT EXISTS undanganku CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
    CREATE USER IF NOT EXISTS 'undanganku'@'localhost' IDENTIFIED BY 'undanganku123';
    GRANT ALL PRIVILEGES ON undanganku.* TO 'undanganku'@'localhost';
    CREATE USER IF NOT EXISTS 'undanganku'@'127.0.0.1' IDENTIFIED BY 'undanganku123';
    GRANT ALL PRIVILEGES ON undanganku.* TO 'undanganku'@'127.0.0.1';
    FLUSH PRIVILEGES;
  " 2>/dev/null || true
  echo "→ MySQL ready."
else
  echo "→ MySQL already running."
fi

# ─── Laravel bootstrap ─────────────────────────────────────────────────────────
echo "→ Running migrations..."
php artisan migrate --force 2>&1 || true

echo "→ Seeding database..."
php artisan db:seed --force 2>&1 || true

php artisan config:clear 2>/dev/null || true
php artisan view:clear  2>/dev/null || true
php artisan storage:link 2>/dev/null || true

echo "→ Starting Laravel server on port 5000..."
exec php artisan serve --host=0.0.0.0 --port=5000
