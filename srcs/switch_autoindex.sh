#!/bin/bash
#
# Enable or disable autoindex in nginx configuration

nginx_conf='/etc/nginx/sites-available/localhost'
is_on='autoindex on;'
is_off='autoindex off;'

# Check param is correct
if [[ "$1" =~ ^(on|ON|off|OFF)$ ]]
then
    # If autoindex is on
    if grep -q "$is_on" "$nginx_conf"
    then
        echo "autoindex is ON"
        if [[ "$1" =~ ^(off|OFF)$ ]]
        then
            sed -i "s/$is_on/$is_off/g" "$nginx_conf"
            state='OFF'
        else
            state='ON'
        fi
    # Else if autoindex is off
    elif grep -q "$is_off" "$nginx_conf"
    then
        echo "autoindex is OFF"
        if [[ "$1" =~ ^(on|ON)$ ]]
        then
            sed -i "s/$is_off/$is_on/g" "$nginx_conf"
            state='ON'
        else
            state='OFF'
        fi
    fi
    service nginx restart
    echo "autoindex is now $state"
    exit 0
else
    echo "Incorrect input"
    echo "Usage: ./switch_autoindex [on/off]"
    exit 1
fi
