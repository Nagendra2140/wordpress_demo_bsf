# wordpress_demo_bsf
wordpress Demo website for bsf

## Prerequisites
  > Server
  > GitHub account
  > Domain
## Server Setup
we need to install required dependencies to host the wordpress apllication.
1. Nginx
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
