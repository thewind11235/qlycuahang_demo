# Requirement
-Ubuntu version >= 20
# Setup server
-nginx\
-php8.1\
-mysql\
-nodejs 16.x, npm, vite
# Setup nginx & php size upload
```
nano /etc/nginx/nginx.conf

client_max_body_size 15M;

nginx -s reload
nano /etc/php/8.1/fpm/php.ini

max_input_time = 24000
max_execution_time = 24000
upload_max_filesize = 12000M
post_max_size = 24000M
memory_limit = 12000M

systemctl restart php8.1-fpm.service
```
# Setup project
```
    echo fs.inotify.max_user_watches=524288 | sudo tee -a /etc/sysctl.conf && sudo sysctl -p
    cd /var/www/
    git clone git@github.com:thewind11235/dien_luc_web.git
    chmod -R 777 dien_luc_web/
    cd dien_luc_web
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    nano .env

    php artisan migrate:refresh
    php artisan migrate --seed
    php artisan storage:link

    chown -R www-data:www-data /var/www/dien_luc_web/public
    chmod 775 /var/www/dien_luc_web/public
    chown -R www-data:www-data /var/www/dien_luc_web/storage

    <!-- npm run build -->

    build apk and put to 'storage/app/downloads/'
    remove git cache: git rm -r --cached .

    runner:
    export RUNNER_ALLOW_RUNASROOT="1"
    sudo ./svc.sh install
    sudo ./svc.sh start
```
