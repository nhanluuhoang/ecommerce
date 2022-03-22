CREATE USER 'laravel_user'@'%' IDENTIFIED BY 'laravel_password';
GRANT ALL PRIVILEGES ON laravel_dev.* TO 'laravel_user'@'%';
FLUSH PRIVILEGES;
