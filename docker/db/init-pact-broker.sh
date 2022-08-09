#!/bin/bash
set -e

psql -v ON_ERROR_STOP=1 --username "$POSTGRES_USER" --dbname "$POSTGRES_DB" <<-EOSQL
	CREATE USER broker_user WITH ENCRYPTED PASSWORD 'broker_password';
	CREATE DATABASE broker;
	GRANT ALL PRIVILEGES ON DATABASE broker TO broker_user;
EOSQL
