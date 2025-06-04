<?php
require_once 'vendor/autoload.php';

use Steampixel\Route;
use Smarty\Smarty;

$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

Route::add('/', function() {
    global $smarty;
    $smarty->display('index.tpl');
});

Route::run('/tebChan');
?>