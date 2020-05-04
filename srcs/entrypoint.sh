#!/bin/bash
#
# Start services

service nginx start \
&& service php7.3-fpm start \
&& service mysql start

# Display real time server logs
tail -f /var/log/nginx/access.log /var/log/nginx/error.log
