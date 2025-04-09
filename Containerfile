FROM php:8.4-apache

RUN ln -fs /usr/share/zoneinfo/Europe/Paris /etc/localtime && \
    dpkg-reconfigure -f noninteractive tzdata

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Install node
ENV NODE_MAJOR=22
RUN apt-get update && apt-get install -y ca-certificates curl gnupg && \
    mkdir -p /etc/apt/keyrings && \
    curl -fsSL https://deb.nodesource.com/gpgkey/nodesource-repo.gpg.key | gpg --dearmor -o /etc/apt/keyrings/nodesource.gpg && \
    echo "deb [signed-by=/etc/apt/keyrings/nodesource.gpg] https://deb.nodesource.com/node_$NODE_MAJOR.x nodistro main" | tee /etc/apt/sources.list.d/nodesource.list && \
    apt-get update && apt-get install nodejs -y && \
    rm -rf /var/lib/apt/lists/* && \
    npm install --global npm@latest

# Configure Apache
RUN cat <<EOF > /etc/apache2/sites-enabled/000-default.conf
<VirtualHost *:80>
    ServerName example.com

    # Uncomment the following line to force Apache to pass the Authorization
    # header to PHP: required for "basic_auth" under PHP-FPM and FastCGI
    #
    # SetEnvIfNoCase ^Authorization$ "(.+)" HTTP_AUTHORIZATION=$1
    DocumentRoot /sources/public
    <Directory /sources/public>
        AllowOverride None
        Require all granted
        Options FollowSymlinks
        FallbackResource /index.php
    </Directory>

    # uncomment the following lines if you install assets as symlinks
    # or run into problems when compiling LESS/Sass/CoffeeScript assets
    # <Directory /var/www/project>
    #     Options FollowSymlinks
    # </Directory>

    ErrorLog /sources/var/log/apache_error.log
    CustomLog /sources/var/log/apache_access.log combined
</VirtualHost>
EOF

RUN mkdir /composer-cache
ENV COMPOSER_HOME=/composer-cache
VOLUME [ "/composer-cache" ]

RUN mkdir /npm-cache && npm config set cache /npm-cache
VOLUME [ "/npm-cache" ]

WORKDIR /sources
