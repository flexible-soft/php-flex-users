<?php

$autoload = include(__DIR__.'/../../../../vendor/autoload.php');
$autoload->addPsr4('App\\', __DIR__.'/../app');

include dirname(__DIR__).'/app/FlexActiveRecord.php';

$app = require __DIR__.'/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();
return $app;
