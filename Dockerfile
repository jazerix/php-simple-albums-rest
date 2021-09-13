FROM phpswoole/swoole:4.6-php8.0-alpine

RUN mkdir /var/app
COPY ./ /var/app
WORKDIR /var/app

CMD ["php", "index.php"]
