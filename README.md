## Installation

### PHP

```bash
sudo apt install php php-dom php-pgsql
```

### Composer

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

sudo mv composer.phar /usr/bin/composer
```

### Project

```bash
# clone the repository
git clone https://github.com/arjun-keyvalue/omegul.git && cd omegul
# install dependencies
composer install
composer dump-autoload
# start the database container
docker-compose up -d
# run the database migrations
./vendor/bin/propel migrate
# start the dev server
php -S $(hostname -I | awk -F' ' '{print $1}'):8000 --docroot=src
# now visit the app on the browser
```
