FROM php:7.4-fpm

RUN apt-get update && \
    apt-get install -y \
    curl libpng-dev libonig-dev \
    libxml2-dev zip unzip \
    nano git libpq-dev tesseract-ocr

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql 

RUN docker-php-ext-install \
    pdo_mysql \
    pdo pdo_pgsql pgsql \
    mbstring \
    exif \
    bcmath \
    pcntl \
    gd

# install composer 
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# set time zone
ENV TZ=Asia/Jakarta
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
RUN touch /usr/local/etc/php/conf.d/uploads.ini && echo "upload_max_filesize = 2000M;" >> /usr/local/etc/php/conf.d/uploads.ini

RUN apt autoremove
WORKDIR /var/www