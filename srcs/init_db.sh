#!/bin/bash
#
# Init database

db_name='wordpress_db'
username='ft_user'
userpassword='ft_password'
hostname='localhost'

# Start service
service mysql start

# Create database user
mysql -e "CREATE USER '$username'@'$hostname' IDENTIFIED BY '$userpassword'"

# phpMyAdmin database
mysql -e "GRANT ALL PRIVILEGES ON phpmyadmin.* TO '$username'@'$hostname';"
mysql -e "FLUSH PRIVILEGES;"

# Wordpress database
mysql -e "CREATE DATABASE $db_name;"
mysql -e "GRANT ALL PRIVILEGES ON $db_name.* TO '$username'@'$hostname';"
mysql -e "FLUSH PRIVILEGES;"

mysql $db_name -u root < /root/wordpress_db.sql
rm /root/wordpress_db.sql
