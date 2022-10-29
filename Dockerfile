# Install Images
FROM bitnami/laravel:8.6.11

# Set working directory
WORKDIR /home/app

# Install packages
RUN apt-get update -y && apt-get upgrade -y

# Copy all files into working directory
COPY . .

# Expose Port
EXPOSE 8000

ENV DB_CONNECTION ${DB_CONNECTION}
ENV DB_HOST ${DB_HOST}
ENV DB_PORT ${DB_PORT}
ENV DB_DATABASE ${DB_DATABASE}
ENV DB_USERNAME ${DB_USERNAME}
ENV DB_PASSWORD ${DB_PASSWORD}
ENV MYSQL_SSL ${MYSQL_SSL}
ENV AZURE_STORAGE_NAME ${AZURE_STORAGE_NAME}
ENV AZURE_STORAGE_KEY ${AZURE_STORAGE_KEY}
ENV AZURE_STORAGE_CONTAINER ${AZURE_STORAGE_CONTAINER}
ENV AZURE_STORAGE_URL ${AZURE_STORAGE_URL}

# Run Composer Update
RUN composer update && cp .env.example .env && php artisan key:generate

# Run script
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
