#!/usr/bin/env bash

NC='\033[0;0m\033[1;0m'
YELLOW='\033[1;33m'
GREEN='\033[0;32m'
CYAN='\033[0;36m'

echo -e "${YELLOW} 🛠️   Installing dependences...${NC}\n"

composer install

echo -e "${GREEN} 🎉   Dependences done!${NC}\n"

./artisan optimize:clear

echo -e "${YELLOW} 🛠️   Running database migrations...${NC}\n"

./artisan migrate \
    --force \
    --step \
    --ansi

echo -e "${GREEN} 🎉   Migrations done!${NC}\n"

echo -e "${YELLOW} 🛠️   Optimizing app...${NC}\n"


./artisan optimize

echo -e "${YELLOW} 🛠️   Application cache done...${NC}\n"

echo -e "${GREEN} 🚀  Running application...${NC}\n"

exec frankenphp run --config /backend/docker/caddy/Caddyfile
