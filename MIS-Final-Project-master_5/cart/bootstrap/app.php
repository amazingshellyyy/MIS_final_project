<?php

use Cart\App;
use Slim\Views\Twig;

use Illuminate\Database\Capsule\Manager as Capsule;

session_start();
require __DIR__ . '/../vendor/autoload.php';

$app = new App;

$container = $app->getContainer();

$capsule = new Capsule;
$capsule->addConnection([
  'driver' => 'mysql',
  'host' => 'localhost',
  'database' => 'MIS2',
  'username' => 'root',
  'password' => '',
  'charset' => 'utf8',
  'collation' => 'utf8_general_ci',
  'prefix' => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();


Braintree_Configuration::environment('sandbox');
Braintree_Configuration::merchantId('s5dcnd3bdvzttqdq');
Braintree_Configuration::publicKey('rvynj899fhvf5by3');
Braintree_Configuration::privateKey('ebc21f5507457fcd7b4e15b6a893aa50');

require __DIR__ . '/../app/routes.php';

$app->add(new \Cart\Middleware\ValidationErrorsMiddleware($container->get(Twig::class)));
$app->add(new \Cart\Middleware\OldInputMiddleware($container->get(Twig::class)));
