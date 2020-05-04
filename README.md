# FT_SERVER

## Description

`ft_server` is an individual school project at [42 Paris](https://www.42.fr) campus.
It is a project that asks you to run a server on Debian Buster through Docker with a Wordpress, Phpmyadmin and Mysql runnning.

## Introduction

<p align="center">
  <img src="assets/index-demo.gif" alt="demo gif" width="800" />
</p>

Docker LEMP development environment for WordPress. For learning purposes only, **not intended for production**.

## Components

* Debian 10
* Nginx
* PHP-FPM (PHP 7.3)
* MariaDB (MySQL)
* phpMyAdmin
* WordPress

### Linux file system structure
We run our project on Debian 10 which uses the Linux kernel.
[More details here](https://www.howtogeek.com/117435/htg-explains-the-linux-directory-structure-explained/)

## PHP MyAdmin
PhpMyAdmin is a free software tool written in PHP, intended to handle the administration of MySQL over the Web.
It will help to link our databases with the rest ouf our services.

## Wordpress
WordPress (WordPress.org) is a content management system (CMS) based on PHP and MySQL that is usually used with the MySQL or MariaDB database

## Usage

### Prerequisites

Docker: https://docs.docker.com/engine/install/

### Common tasks

* `make up` builds the image and runs it as a container
* `make clean` removes the image and the container
* `make autoindex-on` enables directory listing
* `make autoindex-off` disables directory listing

### Acknowledgements

School project done at [42 Paris](https://www.42.fr).

WordPress theme: [Cyanotype](https://wordpress.org/themes/cyanotype/) By Automattic.
