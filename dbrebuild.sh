#!/bin/bash

php app/console doctrine:database:drop --force
php app/console doctrine:database:create
php app/console doctrine:schema:update --force
php app/console doctrine:fixtures:load
php app/console cache:clear --env=prod
php app/console cache:clear
php app/console assets:install --symlink web
chmod -R 777 app/db
