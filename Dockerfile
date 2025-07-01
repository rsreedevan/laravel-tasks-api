From php:8.2-fpm
# Install dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git libzip-dev libpng-dev libjpeg-dev libxml2-dev libxslt-dev curl libcurl4-openssl-dev git libpng-dev \
    && docker-php-ext-install zip pdo pdo_mysql exif gd xml xsl curl bcmath 

COPY --from=composer/composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www    
# Copy application files
COPY . .        
# Install Composer dependencies
RUN composer install --no-interaction --optimize-autoloader 
# Generate application key
RUN php artisan key:generate
# Set permissions for storage and bootstrap/cache directories
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache         
# Expose port 9000
EXPOSE 9000
# Start PHP-FPM server
CMD ["php-fpm"]