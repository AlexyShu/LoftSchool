CREATE USER gp_app WITH PASSWORD 'secret';
CREATE USER gp_app_testing WITH PASSWORD 'secret';

CREATE DATABASE gp_app WITH OWNER gp_app ENCODING 'utf8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8' TEMPLATE template0;
CREATE DATABASE gp_app_testing WITH OWNER gp_app_testing ENCODING 'utf8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8' TEMPLATE template0;

GRANT ALL PRIVILEGES ON DATABASE gp_app TO gp_app;
GRANT ALL PRIVILEGES ON DATABASE gp_app_testing TO gp_app_testing;
