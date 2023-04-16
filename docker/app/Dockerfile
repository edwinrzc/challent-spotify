FROM ubuntu:20.04

LABEL MAINTAINER="Edwin Zapata"

RUN apt-get update \
    && apt-get install -y locales \
    && locale-gen en_US.UTF-8

ENV LANG en_US.UTF-8
ENV LANGUAGE en_US:en
ENV LC_ALL en_US.UTF-8
ENV TZ='America/Buenos_Aires'
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update \
    && apt-get install -y tzdata nginx curl zip unzip git software-properties-common supervisor sqlite3 \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y php8.1-fpm php8.1-cli php8.1-gd php8.1-mysql \
       php8.1-pgsql php8.1-imap php-memcached php8.1-mbstring php8.1-xml php8.1-curl php8.1-gd php8.1-dom \
       php8.1-sqlite3 php8.1-zip \
    && php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
    && mkdir /run/php \
    && apt-get remove -y --purge software-properties-common \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \
    && echo "daemon off;" >> /etc/nginx/nginx.conf \
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

COPY default /etc/nginx/sites-available/default

COPY php-fpm.conf /etc/php/8.1/fpm/php-fpm.conf

EXPOSE 80

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

WORKDIR /var/www/html
CMD ["/usr/bin/supervisord"]
