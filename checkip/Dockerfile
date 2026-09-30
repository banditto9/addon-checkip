ARG BUILD_FROM=ghcr.io/hassio-addons/debian-base:9.5.0
FROM $BUILD_FROM

ARG BUILD_FROM
ENV BASE_IMAGE="$BUILD_FROM"

# Setup base
RUN \
    set -x && \
    apt-get update && \
    apt-get install -y --no-install-recommends \
      gnupg \
      lsb-release \
      openssl \
      nginx \
      gettext-base \
    \
    # Prepare PHP 8.4 repository
    && mkdir -p /etc/apt/keyrings \
    && curl -fsSL https://packages.sury.org/php/apt.gpg \
        | gpg --dearmor -o /etc/apt/keyrings/sury-php.gpg \
    && chmod 644 /etc/apt/keyrings/sury-php.gpg \
    && echo "deb [signed-by=/etc/apt/keyrings/sury-php.gpg] https://packages.sury.org/php/ $(lsb_release -sc) main" \
        > /etc/apt/sources.list.d/php.list \
    \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        php8.4-curl \
        php8.4 \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www

# Copy root filesystem
COPY rootfs /var/www

ENTRYPOINT ["/init"]
