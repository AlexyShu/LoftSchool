# create databases
CREATE DATABASE IF NOT EXISTS loftschool CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

# create db users
CREATE USER 'loftschool'@'%' IDENTIFIED BY 'secret';

GRANT ALL ON loftschool.* TO 'loftschool'@'%';