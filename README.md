Simple user site as a task for ThinkMobiles
===============================
Installation
------------

Create a project:

~~~
git clone https://github.com/tsurkanovm/think_mobiles_task.git project
cd project
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer install
~~~

Init an environment:

~~~
php init
~~~

Fill your DB connection parameters in `common/config/main-local.php`.
Execute migrations:

~~~
php yii migrate
~~~

REQUIREMENTS
------------
The minimum requirement is that your Web server supports PHP 5.4.

