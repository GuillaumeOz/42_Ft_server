# FT_SERVER

## Description

ft_server is a project that asks you to run a server on Debian Buster through Docker with a Wordpress, Phpmyadmin and Mysql runnning.

## Introduction

### Dockerfile
Docker needs to be launche (use the init_docker.sh to launch at 42).
The RUN command open a terminal inside the debian virtual machine.
We use MariaDB as a replacement for MySQL

### Linux file system structure
We run our project on Debian 10 which uses the Linux kernel.
[More details here](https://www.howtogeek.com/117435/htg-explains-the-linux-directory-structure-explained/)

##### /etc
The /etc directory contains configuration files

##### /tmp
Applications store temporary files in the /tmp directory. These files are generally deleted whenever your system is restarted.

##### /usr
The /usr directory contains applications and files used by users, as opposed to applications and files used by the system.

##### /var
The /var directory is the writable counterpart to the /usr directory, which must be read-only in normal operation.

### Nginx
Autoindex enables automated directory interface.
```
The sites-available folder is for storing all of your vhost configurations, whether or not they're currently enabled.

The sites-enabled folder contains symlinks to files in the sites-available folder. This allows you to selectively disable vhosts by removing the symlink.
```
### Nginx: Site Configuration
If you look inside of `/etc/nginx/sites-available` you will find a defaut file that helps you with the configuration file.

#### 301 Redirection
Since we want to use the SSL protocol, we need to redirect to an HTTPS address when calling localhost, we therefore use a [301 redirection](https://en.wikipedia.org/wiki/HTTP_301) from port 80, with
```
	listen 80;
	listen [::]:80;
	server_name localhost www.localhost;
	return 301 https://$server_name$request_uri;
```

### SSL Certificates
We use openSSL to generate the certificates:
```
openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout srcs/nginx-cert.key -out srcs/nginx-cert.crt -config srcs/localhost-ssl.conf
```
[More info here](https://www.humankode.com/ssl/create-a-selfsigned-certificate-for-nginx-in-5-minutes)

## PHP MyAdmin
PhpMyAdmin is a free software tool written in PHP, intended to handle the administration of MySQL over the Web.
It will help to link our databases with the rest ouf our services.

#### Config File
Inside the virtual machine in the /usr/share/phpmyadmin folder we can find the `config.sample.inc.php` that gives us plenty of information on how to configure.

PhpMyAdmin use the [Blowfish cipher](https://en.wikipedia.org/wiki/Blowfish_(cipher)) for encryption. We therefore need to generate a random 32 characters encryption key at the line containing `$cfg['blowfish_secret']`;

## Wordpress
WordPress (WordPress.org) is a content management system (CMS) based on PHP and MySQL that is usually used with the MySQL or MariaDB database

### wp-config file 
The `wp-config.php` file contains your website’s base configuration details, such as database connection information. We just edited the default template for user1 access to the database.

## Steps to get a Docker project running

```shell
# 1 - Build image 'ft_server'
docker build -t ft_server .

# 2 - Run image 'ft_server'
docker run -it -p 80:80 -p 443:443 ft_server
```

### Useful cmd
`service --status-all`