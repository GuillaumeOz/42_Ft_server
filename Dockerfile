# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    Dockerfile                                         :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: gozsertt <gozsertt@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2020/03/31 12:18:06 by gozsertt          #+#    #+#              #
#    Updated: 2020/05/04 19:41:00 by gozsertt         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

FROM debian:buster

LABEL maintainer="Guillaume Ozserttas gozsertt@student.42.us.org"

# Install necessary packages
RUN apt-get update && apt-get install -y \
    vim-gtk exuberant-ctags \
    wget \
    curl \
    nginx \
    php-fpm php-mysql \
    mariadb-server \
    php-curl php-gd php-intl php-mbstring php-soap php-xml php-xmlrpc php-zip \
 && rm -rf /var/lib/apt/lists/*

# Set up NGINX
RUN mkdir -p /var/www/localhost/html/ \
 && chown -R www-data:www-data /var/www/localhost
COPY srcs/localhost /etc/nginx/sites-available/localhost
RUN ln -s /etc/nginx/sites-available/localhost /etc/nginx/sites-enabled/
COPY srcs/index.html /var/www/localhost/html/
COPY srcs/favicon.ico /var/www/localhost/

# Generate a self-signed certificate and private key using OpenSSL
RUN cd /etc/ssl/certs/ \
 && openssl req -x509 -days 90 \
    -out localhost.crt \
    -keyout localhost.key \
    -newkey rsa:2048 -nodes -sha256 \
    -subj '/CN=localhost' \
 && chmod 600 /etc/ssl/certs/localhost.key \
 && chmod 600 /etc/ssl/certs/localhost.crt

# Get and set up phpMyAdmin
RUN cd /tmp/ && wget https://files.phpmyadmin.net/phpMyAdmin/4.9.2/phpMyAdmin-4.9.2-all-languages.tar.gz \
 && mkdir /var/www/localhost/phpmyadmin \
 && tar -C /var/www/localhost/phpmyadmin -xvf phpMyAdmin-4.9.2-all-languages.tar.gz --strip 1 \
 && chown -R www-data:www-data /var/www/localhost/phpmyadmin
COPY srcs/config.inc.php /var/www/localhost/phpmyadmin

# Init database
COPY srcs/init_db.sh /scripts/
COPY srcs/wordpress/wordpress_db.sql /root/
RUN bash scripts/init_db.sh

# Get and setup WordPress
RUN cd /tmp/ && wget https://wordpress.org/latest.tar.gz \
 && tar -C /var/www/localhost/ -xvf latest.tar.gz \
 && chown -R www-data:www-data /var/www/localhost/wordpress
COPY srcs/wordpress/wp-config.php /var/www/localhost/wordpress
# WordPress styling
COPY srcs/wordpress/cyanotype /var/www/localhost/wordpress/wp-content/themes/cyanotype
COPY srcs/favicon.ico /var/www/localhost/wordpress/wp-content/uploads/2020/05/
COPY srcs/wordpress/42wallpaper.jpg /var/www/localhost/wordpress/wp-content/uploads/2020/05/

# Informs which ports are intended to be published
EXPOSE 80 443

# Copy script to enable or disable autoindex
COPY srcs/switch_autoindex.sh /scripts/

# Start services
COPY srcs/entrypoint.sh /scripts/
ENTRYPOINT ["bash", "/scripts/entrypoint.sh"]
