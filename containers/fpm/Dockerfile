FROM php:7.4-fpm-alpine
MAINTAINER Kenan Rhoton

# Framebuffer to render webpages and some font packages to make them look right
# Our html to PDF renderer
# GMP Needed for the base62 encoding and decoding
RUN apk add --no-cache xvfb ttf-freefont fontconfig dbus wkhtmltopdf gmp-dev

RUN docker-php-ext-install gmp

# Wrap the wkhtmltopdf executable to run in a framebuffer
RUN mv /usr/bin/wkhtmltopdf /usr/bin/wkhtmltopdf-origin
COPY scripts/wkhtmlwrapper.sh /usr/bin/wkhtmltopdf
RUN chmod +x /usr/bin/wkhtmltopdf

# Copy our web files
COPY web/ /var/www/html/

# Create a folder with permissions to keep our generated PDFs
RUN mkdir /var/www/html/pdfs && chmod -R 777 /var/www/html/pdfs
