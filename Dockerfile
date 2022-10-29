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

# Run Composer Update
RUN ["compose", "update"]

# Run script
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
