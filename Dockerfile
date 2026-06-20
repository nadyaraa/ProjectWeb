FROM php:8.3-apache

# 1. Install dependensi sistem yang dibutuhkan Laravel & SQLite
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libsqlite3-dev \
    zip \
    unzip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# 2. Install & aktifkan ekstensi PHP bawaan
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql pdo_sqlite gd bcmath

# 3. Aktifkan modul mod_rewrite Apache untuk rute Laravel
RUN a2enmod rewrite

# 4. Ubah Document Root Apache ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Tentukan folder kerja di dalam server
WORKDIR /var/www/html
COPY . .

# 6. Install Composer & dependensi Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 7. Siapkan file database SQLite kosong dan atur hak aksesnya
RUN touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache database

EXPOSE 80