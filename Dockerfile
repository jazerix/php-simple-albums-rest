FROM php:8.0

RUN mkdir /var/app
COPY ./ /var/app
WORKDIR /var/app

CMD ["php", "-S", "0.0.0.0:80"]
