# wordpress_demo_bsf
wordpress Demo website for bsf

## Prerequisites
1. Server Ubuntu(22.04).
2. GitHub account.
3. Domain.
## Domain setup
After launching the server we need to assign domain to that server IP
we need to create one A record with that server IP
## Server Setup
we need to install required dependencies to host the wordpress apllication.
### 1. Nginx
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
### 2. PHP
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
### 3. MySQL
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
4. After adding credentials we need to create the conf in nginx for our wordpress application. Below conf file i used for our application.
```sh
server {
    server_name wordpress.nanisys.online;

    root /var/www/wordpress.nanisys.online/wordpress_demo_bsf;
    index index.php;

    access_log /var/log/nginx/wordpress.nanisys.online.access.log;
    error_log /var/log/nginx/wordpress.nanisys.online.error.log;

    location / {
        try_files $uri $uri/ /index.php?$args;
    }

    location ~ \.php$ {
        fastcgi_cache_valid 200 301 302 10m;
        fastcgi_cache_valid 404 1m;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;  # Adjust this path for your PHP version
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }

    location ~ /\.ht {
        deny all;
    }

    location = /favicon.ico {
        log_not_found off;
        access_log off;
    }

    location = /robots.txt {
        allow all;
        log_not_found off;
        access_log off;
    }

    location ~* \.(css|gif|ico|jpeg|jpg|js|png)$ {
        expires max;
        log_not_found off;
    }

    listen 443 ssl;
    ssl_certificate /etc/letsencrypt/live/wordpress.nanisys.online/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/wordpress.nanisys.online/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}
server {
    if ($host = wordpress.nanisys.online) {
        return 301 https://$host$request_uri;
    }
    listen 80;
    server_name wordpress.nanisys.online;
    return 404;
}
```
5. After creating the conf file we need to restart the nginx.
## GitHub
1. In github we need to create the new repository and then we need to push our code to the repository.
2. After pushing code to the repository we can setup the CICD using github actions.
### Procedure has to follow after code pushed to github.
1. we need delete the previous created code from server.
2. Again we need to clone the code from GitHub. So then we can implement the CICD.
## CICD implementation
I used below script to implement cicd for wordpress application.
```sh
name: Deploy PHP/WordPress Application

on:
  push:
    branches:
      - master

jobs:
  deploy:
    runs-on: ubuntu-latest

    steps:
      - name: Checkout Code
        uses: actions/checkout@v2

      - name: Set up SSH
        uses: webfactory/ssh-agent@v0.5.3
        with:
          ssh-private-key: ${{ secrets.SSH_PRIVATE_KEY }}

      - name: Backup Old Code
        run: |
          # SSH into the server
          ssh -o StrictHostKeyChecking=no ${{ secrets.SSH_USERNAME }}@${{ secrets.SSH_HOST }} << 'ENDSSH'

            # Change to the application directory
            cd /var/www/wordpress.nanisys.online/wordpress_demo_bsf

            # Create a timestamp for the backup
            backup_timestamp=$(date +"%Y-%m-%d-%H-%M-%S")

            # Zip the old code and move it to the backup directory
            zip -r "/opt/backups/wordpress_${backup_timestamp}.zip" .

          ENDSSH

      - name: Deploy New code via SSH
        run: |

          # SSH into the server
          ssh -o StrictHostKeyChecking=no ${{ secrets.SSH_USERNAME }}@${{ secrets.SSH_HOST }} << 'ENDSSH'
            
          # Change to the application directory
          cd /var/www/wordpress.nanisys.online/wordpress_demo_bsf

          # Pull the latest changes from the repository
          git pull origin master

          ENDSSH
```
1. we can implement cicd in different methods.
2. The method i used is directly we can pull our latest changes inside the server. we can use scp method also as per requirements.
3. By using GitHub secrets we can save our credentials like username,IP,keyfiles,port etc. Instead of admins no one can see that credentials.
### Best practices and Security
1. For every deployment we need to take old code backup.
2. we need to implement daily backups for database and need to save in S3 or something.
3. Security group port restrictions.
4. changing SSH port (22) to different port.
5. Need to update plugins regularly.
6. Need to Enable 2FA for WordPress logins.
7. Need to Disable directory listing in web server configuration to prevent attackers from file structure.
8. Need to change the default WordPress database table prefix (e.g., "wp_") to something unique.
9. Need implement CSP,HSTS and X-frame options in web server(nginx).
10. We can implement LoadBalancers for high availability.
