---
name: MySQL Setup via start.sh
description: MySQL 8.0 must be started via start.sh before Laravel; cannot use standalone bash sessions
---

## Setup

MySQL 8.0 installed via `installSystemDependencies({ packages: ["mysql80"] })`.
Data directory: `/home/runner/.mysql/data`
Socket: `/home/runner/.mysql/mysql.sock`
Logs: `/home/runner/.mysql/logs/`

## Critical: Must run via workflow, not standalone bash

MySQL started with `--daemonize=ON` from bash sessions gets killed when the session ends (SIGTERM).
The only reliable way to keep MySQL running is via the `start.sh` workflow script.

The workflow command is `bash start.sh` which:
1. Checks if MySQL data dir exists; initializes if not
2. Starts mysqld if not already running
3. Creates DB/user on first boot
4. Runs `php artisan migrate --force`
5. Runs `php artisan db:seed --force`
6. Starts Laravel with `exec php artisan serve --host=0.0.0.0 --port=5000`

## Database credentials
- DB: `undanganku`
- User: `undanganku` / `undanganku123`
- Root: no password
- Connection: `127.0.0.1:3306`

## .env config
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=undanganku
DB_USERNAME=undanganku
DB_PASSWORD=undanganku123
```

**Why:** Replit's sandbox sends SIGTERM to child processes when a bash tool session ends. Only processes started as part of the workflow's process tree survive.

**How to apply:** Never try to start MySQL in a standalone bash command for persistence. Always rely on start.sh / the workflow.
