FROM node:lts-alpine

RUN \
    apk add --no-cache \
    bash \
    pnpm \
    libxml2-dev \
    libzip-dev \
    && rm -rf /var/cache/apk/*

RUN mkdir /frontend \
    && chown -R node:node /frontend \
    && mkdir /pnpm-store \
    && chown -R node:node /pnpm-store

USER node:node

WORKDIR /frontend

EXPOSE 3100

ENV CI=true



