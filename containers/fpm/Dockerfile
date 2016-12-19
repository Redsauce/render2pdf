FROM php:7.0-fpm
MAINTAINER Kenan Rhoton
RUN apt-get update

# Framebuffer to render webpages and some font packages to make them look right
RUN apt-get install -y xvfb ttf-freefont fontconfig dbus

# Our html to PDF renderer
RUN apt-get install -y wkhtmltopdf

# Needed for the base62 encoding and decoding
RUN apt-get install -y libgmp-dev
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h
RUN docker-php-ext-install gmp

# Wrap the wkhtmltopdf executable to run in a framebuffer
RUN mv /usr/bin/wkhtmltopdf /usr/bin/wkhtmltopdf-origin
COPY scripts/wkhtmlwrapper.sh /usr/bin/wkhtmltopdf
RUN chmod +x /usr/bin/wkhtmltopdf

# Copy our web files
COPY web/ /var/www/html/

# Create a folder with permissions to keep our generated PDFs
RUN mkdir /var/www/html/pdfs && chmod -R 777 /var/www/html/pdfs
