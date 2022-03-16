## Instructions for unfolding

* Run a git clone of the project
* Run command: `composer update`
* Run command: `copy .env.example .env`
* Run command: `php artisan key:generate`
* Run command: `npm i`
* Run command: `npm run dev`
* In the .env file, edit the configs
* Run command: `php artisan migrate`
* Run command: `php artisan db:seed`
* Enable storage: `php artisan storage:link`
* Set permissions: `sudo chmod -R 755 bootstrap/cache`
* Set permissions: `sudo chmod -R 755 storage`
* Customize the transition to the public folder
* Run command `php artisan passport:install`


## Account access

     login: admin@g.com
     password:dWQD324s5d1vusd4


## Task for the project

Implement a small web application that includes three blocks:
1. Showing the current (today) exchange rate
2. The history of changes in the exchange rate of a certain currency for a period (between two dates) in a table format: date, difference from the previous date.
3. Currency converter with date selection (you can set the currency and date, and in return get how much UAH you need to buy currency on the specified date)
   To get exchange rates use the NBU API
   https://old.bank.gov.ua/control/uk/publish/article?art_id=38441973
   Front and back communication should be organized via API. You can use any framework (for example Laravel + Vue.js).
