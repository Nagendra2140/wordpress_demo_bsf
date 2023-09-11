# wordpress_demo_bsf
wordpress Demo website for bsf

## Prerequisites
1. Server Ubuntu(22.04).
2. GitHub account.
3. Domain.
## Server Setup
we need to install required dependencies to host the wordpress apllication.
1. ### Nginx
   Required commands to install latest version of nginx.
```sh
$ sudo apt install curl gnupg2 ca-certificates lsb-release ubuntu-keyring
$ curl https://nginx.org/keys/nginx_signing.key | gpg --dearmor \
    | sudo tee /usr/share/keyrings/nginx-archive-keyring.gpg >/dev/null
$ gpg --dry-run --quiet --import --import-options import-show /usr/share/keyrings/nginx-archive-keyring.gpg
$ echo "deb [signed-by=/usr/share/keyrings/nginx-archive-keyring.gpg] http://nginx.org/packages/ubuntu `lsb_release -cs` nginx" | sudo tee /etc/apt/sources.list.d/nginx.list
$sudo apt update
$sudo apt install nginx
```
2. ### PHP
   Commands to install php and dependencies.
```sh
$ sudo apt install ghostscript \
                 php \
                 php-bcmath \
                 php-curl \
                 php-imagick \
                 php-intl \
                 php-json \
                 php-mbstring \
                 php-mysql \
                 php-xml \
                 php-zip
```
3. ### MySQL
   Command to install and setup mysql database.
```sh
sudo apt install mysql-server
```
#### MySQL shell commands
```sh
$ CREATE DATABASE <database_name>;
$ CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
$ GRANT ALL PRIVILEGES ON <database_name>.* TO 'username'@'localhost';
$ FLUSH PRIVILEGES;
$ exit
```
## Wordpress application setup.
There are different ways to setup the application. I mentioning the procedure that I followed.
1. Create the directory.
```sh
sudo mkdir -p /var/www/wordpress.nanisys.online
```
2. Download the wordpress code file form official site [WordPress.org](https://wordpress.org/).
```sh
curl https://wordpress.org/latest.tar.gz | sudo tar zx -C /var/www/wordpress.nanisys.online
```
3. Now we need to add the database credentials in wp-config.php
4. After adding credentials we need to create the conf in nginx for our wordpress application.
5. After creating the conf file we need to restart the nginx.
## GitHub
1. In github we need to create the new repository and then we need to push our code to the repository.
2. After pushing code to the repository we need to setup the CICD using github actions.
### Procedure has to follow after code pushed to github.
1. we need delete the previous created code from server.
2. After that we need to clone the code from GitHub. So then we can implement the CICD.
