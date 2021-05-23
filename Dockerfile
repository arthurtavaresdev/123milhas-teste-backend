# Base image
FROM arthurabreu00/laravel-docker:latest

# Set working directory
WORKDIR /var/www/html

# Add user
RUN groupadd --force -g 1000 123milhas
RUN useradd -ms /bin/bash --no-user-group -g 1000 -u 1337 123milhas

# Install xdebug
# RUN pecl install xdebug
# RUN docker-php-ext-enable xdebug

# Copy config files
COPY ./docker/php/www.conf /usr/local/etc/php-fpm.d/
COPY ./docker/php/local.ini /usr/local/etc/php/conf.d/
# COPY ./docker/php/xdebug.ini /usr/local/etc/php/conf.d/

# Copy existing application directory contents
COPY --chown=123milhas:123milhas . /var/www/html

# Expose port
EXPOSE 80

# Entrypoint
ENTRYPOINT ["sh", "/var/www/html/docker/sh/entrypoint.sh"]
