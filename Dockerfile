FROM php:8.3-fpm

# Instala dependências do sistema e Nginx
RUN apt-get update && apt-get install -y \
    nginx \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    libzip-dev \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev

# Limpa cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instala extensões PHP
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www

# Copia os arquivos do projeto
COPY . .

# Instala dependências do Laravel
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Configura permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copia configurações do Docker
COPY docker/nginx.conf /etc/nginx/sites-available/default
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Torna o entrypoint executável
RUN chmod +x /usr/local/bin/entrypoint.sh

# Render usa a porta definida na variável $PORT (padrão 10000)
EXPOSE 80

ENTRYPOINT ["entrypoint.sh"]
