#!/bin/bash
set -e

# ─── Generate .env from environment variables ──────────────────────────────────
echo "→ Writing .env file..."
cat > .env <<EOF
APP_NAME="${APP_NAME:-UndanganKu}"
APP_ENV="${APP_ENV:-local}"
APP_KEY="${APP_KEY}"
APP_DEBUG="${APP_DEBUG:-true}"
APP_URL="https://${REPLIT_DEV_DOMAIN:-localhost}"

APP_LOCALE="${APP_LOCALE:-en}"
APP_FALLBACK_LOCALE="${APP_FALLBACK_LOCALE:-en}"
APP_FAKER_LOCALE="${APP_FAKER_LOCALE:-en_US}"

APP_MAINTENANCE_DRIVER="${APP_MAINTENANCE_DRIVER:-file}"

BCRYPT_ROUNDS="${BCRYPT_ROUNDS:-12}"

LOG_CHANNEL="${LOG_CHANNEL:-stack}"
LOG_STACK="${LOG_STACK:-single}"
LOG_DEPRECATIONS_CHANNEL="${LOG_DEPRECATIONS_CHANNEL:-null}"
LOG_LEVEL="${LOG_LEVEL:-debug}"

DB_CONNECTION="${DB_CONNECTION:-mysql}"
DB_HOST="${DB_HOST:-127.0.0.1}"
DB_PORT="${DB_PORT:-3306}"
DB_DATABASE="${DB_DATABASE:-undanganku}"
DB_USERNAME="${DB_USERNAME:-undanganku}"
DB_PASSWORD="${DB_PASSWORD:-undanganku123}"

SESSION_DRIVER="${SESSION_DRIVER:-database}"
SESSION_LIFETIME="${SESSION_LIFETIME:-120}"
SESSION_ENCRYPT="${SESSION_ENCRYPT:-false}"
SESSION_PATH="${SESSION_PATH:-/}"
SESSION_DOMAIN="${SESSION_DOMAIN:-null}"

BROADCAST_CONNECTION="${BROADCAST_CONNECTION:-log}"
FILESYSTEM_DISK="${FILESYSTEM_DISK:-local}"
QUEUE_CONNECTION="${QUEUE_CONNECTION:-database}"

CACHE_STORE="${CACHE_STORE:-database}"

MAIL_MAILER="${MAIL_MAILER:-log}"
MAIL_SCHEME="${MAIL_SCHEME:-null}"
MAIL_HOST="${MAIL_HOST:-127.0.0.1}"
MAIL_PORT="${MAIL_PORT:-2525}"
MAIL_USERNAME="${MAIL_USERNAME:-null}"
MAIL_PASSWORD="${MAIL_PASSWORD:-null}"
MAIL_FROM_ADDRESS="${MAIL_FROM_ADDRESS:-hello@undanganku.com}"
MAIL_FROM_NAME="${MAIL_FROM_NAME:-UndanganKu}"

VITE_APP_NAME="${VITE_APP_NAME:-UndanganKu}"
EOF
echo "→ .env written."

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
