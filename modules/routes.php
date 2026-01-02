<?php

use Illuminate\Support\Facades\Route;

$modules = glob(__DIR__ . '/*/Routes/web.php');

foreach ($modules as $routesFile) {
    require $routesFile;
}
