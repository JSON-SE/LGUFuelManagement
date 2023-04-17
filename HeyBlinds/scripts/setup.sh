#! /bin/bash

echo "~ go to the directory"
cd /var/www/html/heyblinds

#composer require spatie/laravel-sitemap
#sudo chmod -R 777 /var/www/html/heyblinds/storage/app/public/*
#sudo chmod -R 777 /var/www/html/heyblinds/storage/app/public/upload/color/feature/image-jpeg/*
#sudo chmod -R 777 /var/www/html/heyblinds/storage/app/public/upload/color/feature/image-jpeg/2021-03-11/thumbnail/*
#composer require yajra/laravel-datatables:^1.5
# echo "~ composer update"
# composer update
npm  install

#php artisan db:seed
#npm install
#composer require dompdf/dompdf
#composer require maatwebsite/excel
# php artisan migrate:fresh --seed
#composer require stevebauman/location
#composer require pion/laravel-chunk-upload
#composer require shetabit/visitor
#composer require yoeunes/toastr
#composer require barryvdh/laravel-dompdf
npm run production


#composer require intervention/image
php artisan storage:link
php artisan queue:restart
#php artisan migrate --force

#echo "~ composer update"
php artisan config:clear && php artisan route:clear && php artisan route:cache && php artisan view:clear && php artisan clear-compiled && php artisan optimize && composer dumpautoload -o && php artisan config:cache



#pm2 restart heyblinds-queue-worker
#pm2 update
#echo "~ composer update"

echo "~ Supervisor Service Restart"
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl reload
sudo service supervisor restart

sudo chown ubuntu:www-data -R storage/*
sudo chmod 777 -R storage/*
sudo chmod 777 -R /var/www/html/heyblinds/storage/logs/*
