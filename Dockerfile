# Use a imagem base do PHP 8.2 FPM
FROM php:8.2-fpm

# Instalação do Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalação de dependências adicionais necessárias
RUN apt-get update && apt-get install -y \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        libpq-dev \
        && docker-php-ext-install pdo pdo_pgsql pgsql

# Instalação da extensão PHP Redis
RUN pecl install redis \
    && docker-php-ext-enable redis

RUN composer install

# Limpeza do cache de pacotes
RUN apt-get clean && rm -rf /var/lib/apt/lists/*



# Exemplo de comando para copiar o código da aplicação (substitua pelo seu método de cópia)
# COPY . /var/www/html

# Comando opcional para instalar dependências PHP usando o Composer
 RUN composer install --no-dev

# Comando opcional para ajustar permissões, se necessário
 RUN chown -R www-data:www-data /var/www/html

# Comando opcional para expor a porta, se necessário
# EXPOSE 9000

# Comando opcional para rodar o PHP-FPM (pode ser gerenciado por um entrypoint personalizado)
# CMD ["php-fpm"]
