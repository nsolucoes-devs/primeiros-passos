#!/bin/bash
#
# Backup mysql/mariadb database

## Get current date ##
_now=$(date +%H_%M__%d_%m_%Y)

## Appending a current date from a $_now to a filename stored in $_file ##
_file="backup$_now.sql"

## Remove old files
echo "Removing old backup of $_file..."
rm "db_bkp/$_file"

## Do it ##
echo "Starting backup to $_file..."
mysqldump -h <hostname> -u <user> -p<password> -R --opt <database> --no-tablespaces > "db_bkp/$_file"