# STAGE 1: Kompilasi Aset Frontend (Vite & Tailwind CSS)
FROM node:20 AS frontend-builder
WORKDIR /app
COPY . .
RUN npm install && npm run build

# STAGE 2: Konfigurasi Server Aplikasi Utama (PHP & Apache)
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
RUN echo "upload_max_filesize = 5M" > /usr/local/etc/php/conf.d/uploads.ini \
    && echo "post_max_size = 5M" >> /usr/local/etc/php/conf.d/uploads.ini

# 4. Ubah Document Root Apache ke folder /public milik Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# 5. Tentukan folder kerja di dalam server
WORKDIR /var/www/html
COPY . .

# 🗂️ SALIN ASET VITE YANG SUDAH DIKOMPILASI DARI STAGE 1
COPY --from=frontend-builder /app/public/build /var/www/html/public/build

# 6. Install Composer & dependensi Laravel
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 7. Siapkan file database SQLite kosong dan atur hak aksesnya
RUN touch database/database.sqlite \
    && chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache database public/build

EXPOSE 80

# 8. Otomatisasi Runtime (Eksekusi otomatis setiap kali kontainer dinyalakan/terbangun)
CMD php artisan migrate --force && php artisan db:seed --force && php artisan storage:link --force && chown -R www-data:www-data /var/www/html/storage /var/www/html/database && apache2-foreground