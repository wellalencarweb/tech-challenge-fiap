#!/bin/bash

if [ ! -f .env ]; then
    cp .env.example .env
fi

make build

make migrate-fresh-seed
