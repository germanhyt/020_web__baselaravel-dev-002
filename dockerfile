# Construcción de la aplicación
FROM elrincondeisma/php-for-laravel:8.3.7

# Establece el directorio de trabajo dentro del contenedor

WORKDIR /app

# Copia solo los archivos necesarios para instalar las dependencias
COPY . .

# Instala las dependencias de Composer
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copia el archivo de entorno
COPY .env .env

# Crea el directorio de logs
RUN mkdir -p /app/storage/logs

# Genera la clave de la aplicación de Laravel
RUN php artisan key:generate

# Asegura que los permisos sean correctos para las carpetas de almacenamiento y caché
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache


# Expone el puerto 8000 para la aplicación Laravel (puerto común para PHP built-in server)
EXPOSE 8000

# Comando para iniciar la aplicación
CMD php artisan serve --host=0.0.0.0 --port=8000