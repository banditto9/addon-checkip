ARG BUILD_FROM=ghcr.io/hassio-addons/debian-base:9.5.0
FROM $BUILD_FROM

RUN \
    apt-get update \
    && apt-get install -y --no-install-recommends \
        nginx \
        php-fpm \
    && rm -f /etc/nginx/sites-enabled/default \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Files land in / (nginx.conf, php-fpm conf, s6 services, /var/www/index.php)
COPY rootfs /
RUN chmod a+x /etc/services.d/*/run
