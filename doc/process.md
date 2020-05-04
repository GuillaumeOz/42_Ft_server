# Process

## TODO

- [ ] Dockerfile at the root of the repository
- [ ] All configuration files in `srcs`
- [ ] Set up a web server with NGINX, in only one docker container
- [ ] The container OS must be debian buster
- [ ] The web server must be able to run several services at the same time: a WordPress website, phpMyAdmin and MySQL
- [ ] Make sure the SQL database works with the WordPress and phpMyAdmin
- [ ] The server should be able to use the SSL protocol
- [ ] Make sure that, depending on the url, the server redirects to the correct website
- [ ] Make sure the server is running with an autoindex that must be able to be disabled

## Walkthrough

### Understand what is expected

> Use Docker to install a complete web server.

You have to turn-in a Dockerfile at the root of the repository.

If you're not familiar with Docker, start by learning more about Dockerfile, basic commands, building and running images.

- [Debian Dockerfile man](https://manpages.debian.org/buster/docker.io/Dockerfile.5.en.html)
- [docker docs: Build and run your image](https://docs.docker.com/get-started/part2/)

You are required to deliver the following services: a WordPress website, phpMyAdmin and MySQL. In other words, to dockerize a LEMP stack for WordPress.

LEMP stack stands for:
- Linux operating system
- NGINX web server
- MariaDB database to store the backend data (Debian formerly used MySQL)
- PHP to handle dynamic processing

Since the base image must be Debian Buster (Debian 10), we have to use MariaDB which is a fork of MySQL. Debian now only ships with MariaDB packages.

The project aims to make us learn Docker and automation. We may deduce the purpose is not to turn-in a short Dockerfile using shell scripts that will install and configure everything. The more steps we put in the Dockerfile, the better it is.

### Write the Dockerfile and get your container up and running

Now you identified what is expected, you can write a short Dockerfile to build and run the image.

Use the `-it` flag (short for `--interactive` + `--tty`) and the command `bash` to get straight inside the container.

You can create a Makefile or a shell script to automate the building and running tasks.

### Understand and install the environment

You can now follow the tutorial of your choice to install the LEMP stack in your container:

- [Install LEMP Stack on Debian 10 Buster](https://kifarunix.com/install-lemp-stack-on-debian-10-buster/)
- [How To Install Linux, Nginx, MariaDB, PHP (LEMP stack) on Debian 10](https://www.digitalocean.com/community/tutorials/how-to-install-linux-nginx-mariadb-php-lemp-stack-on-debian-10)

My process is to do the installation inside the container manually and step-by-step. At each step, I transcribe the actions that were performed in my Dockerfile, then I re-build and re-run the image to ensure the automated actions succeeded and repeat this with the next step until everything is set up.

Start by installing NGINX and PHP-FPM (FastCGI Process Manager).

PHP-FPM is a process manager. It is like another server in itself, which dynamically manages some child PHP processes:
1. A client (browser) sends a request to a server running PHP.
2. PHP doesn’t directly receive it. The HTTP server does. The web server knows how to connect to PHP and passes all the request data to PHP.
3. PHP sends the output back to the web server.
4. The web server sends it back to the client.

nginx.conf:
```
server {
# Listen to port 80 on IPv4
        listen 80;
# Listen to port 80 on IPv6
        listen [::]:80;

# Our domain name
        server_name localhost;

# Directory for our app files
        root /var/www/localhost;

# Order of execution of index
        index index.php index.html;

        location / {
            try_files $uri $uri/ =404;
        }

        location ~ \.php$ {
            include snippets/fastcgi-php.conf;
            fastcgi_pass unix:/run/php/php7.3-fpm.sock;
        }
}
```

- `include snippets/fastcgi-php.conf` includes PHP-FastCGI default site configuration file
- `fastcgi_pass unix:/run/php/php7.3-fpm.sock` tells Nginx to communicate with the PHP process through the socket named `php7.3-fpm.sock`

Install MariaDB and get familiar with it. Create a test database and keep the test files.

Don't forget to enable TLS for HTTPS connections. Since your use is for local development and learning purposes, generate a private key and self-signed certificate for localhost with `openssl`. Your browser will warn you the certificate was self-signed which isn't a problem at all for this school project.

- [Configuring HTTPS servers](http://nginx.org/en/docs/http/configuring_https_servers.html)
- [Certificates for localhost](https://letsencrypt.org/docs/certificates-for-localhost/)

Check your NGINX configuration for syntax errors with:

```console
nginx -t
```

You need to have two separate configuration block for HTTP and HTTPS:
- A server block for HTTP which redirects all HTTP requests to HTTPS.
- A server block for HTTPS, which serves the actual content.

The [HTTP response status code 301](https://en.wikipedia.org/wiki/HTTP_301) Moved Permanently is used for permanent URL redirection.

nginx.conf:
```
# Block for HTTP server on port 80
server {
        listen 80;
        listen [::]:80;

        server_name localhost;

        # Redirects all HTTP requests to HTTPS
        return 301 https://$server_name$request_uri;
}

# Block for HTTPS server on port 443
server {
        listen 443 ssl;
        listen [::]:443 ssl;

        ssl_certificate /etc/ssl/certs/localhost.crt;
        ssl_certificate_key /etc/ssl/certs/localhost.key;

        server_name localhost;

        root /var/www/localhost;
        index index.html index.php;

        location / {
            try_files $uri $uri/ /index.html =404;
        }
}
```

At each step, in your web browser, check everything works the way it should.

When running the container, use the `--publish` or `-p` flag with the right ports.

### Install and configure phpMyAdmin

phpMyAdmin is intended to handle the administration of MySQL.

Create and update the phpMyAdmin configuration file `/var/www/localhost/phpmyadmin/config.inc.php`.

- [phpMyAdmin Docs: Configuration](https://docs.phpmyadmin.net/en/latest/config.html)

Fill this with a 32 characters long random passphrase:
```
$cfg['blowfish_secret'] = ''; /* YOU MUST FILL IN THIS FOR COOKIE AUTH! */
```

> The configuration is called blowfish_secret for historical reasons as Blowfish algorithm was originally used to do the encryption.

Uncomment the appropriate lines.

### Install and configure WordPress

Once you have completed the requirements, it's time to install WordPress. You will need additional PHP extensions.

- [How To Install WordPress with LEMP (Nginx, MariaDB and PHP) on Debian 10](https://www.digitalocean.com/community/tutorials/how-to-install-WordPress-with-lemp-nginx-mariadb-and-php-on-debian-10)

Since WordPress needs a MySQL-based database to store and manage site and user information, start by creating a database and a user specifically for WordPress. For security concerns, another user than root manages the database. Flush the privileges to notify the server about the changes.

`www-data` is the user that web servers on Linux use by default for normal operation.

NGINX needs to be able to read and write WordPress files:

```console
chown -R www-data:www-data /var/www/localhost
```

You have to set secure keys our in configuration file `/var/www/localhost/WordPress/wp-config.php`.

Grab secure values from the WordPress secret key generator:

```console
curl -s https://api.WordPress.org/secret-key/1.1/salt/
```

For the ft_server project, the lines you will get can be anything so you can change them to reset all user sessions. Replace the dummy values in the configuration file `/var/www/your_domain/localhost/wp-config.php` and update the database connection settings. You can also set the site URL.

The server configuration is now complete. Make sure the SQL database works with the WordPress and phpMyAdmin.

In your web browser, check the server redirects to the correct website.

### autoindex

You have to ensure the server is running with an autoindex that must be able to be disabled.

- [Module ngx_http_autoindex_module](http://nginx.org/en/docs/http/ngx_http_autoindex_module.html)

> This topic is intended to introduce you to system administration. It will make you aware
of the importance of using scripts to automate your tasks.

The purpose seems to automate the ability to enable or disable the autoindex.

Just add `autoindex on` to your nginx.conf to produce a directory listing:
```
location / {
    autoindex on;
}
```

- [How to use sed to find and replace text in files in Linux / Unix shell](https://www.cyberciti.biz/faq/how-to-use-sed-to-find-and-replace-text-in-files-in-linux-unix-shell/)

Then feel free to write a shell script and place it in the appropriate folder.

### Bonus

You can add a custom `index.html` page and a `favicon.ico` placed in the root directory of your website. You can also quickly style your WordPress site.

### Checking

- Ensure your Dockerfile is located at the root of the repository.
- Ensure all configuration files are located in `srcs`.
- Add a script or Makefile to help building and running image for peer-to-peer evaluations. It will also be convenient to keep this Makefile for future Docker-related projects.
