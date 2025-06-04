<?php
require_once 'vendor/autoload.php';
require_once 'class/Image.php';
require_once 'class/Post.php';

use Steampixel\Route;
use Smarty\Smarty;


$smarty = new Smarty();
$smarty->setTemplateDir('templates');
$smarty->setCompileDir('templates_c');
$smarty->setCacheDir('cache');
$smarty->setConfigDir('configs');

Route::add('/', function() {
    $posts = Post::getList();
    global $smarty;
    $smarty->assign('posts', $posts);
    $smarty->display('index.tpl');
});

Route::add('/upload', function() {
    $imageUrl = Image::Upload($_FILES['file']);
    Post::add($imageUrl, $_POST['content'], $_POST['parent']);
    header('Location: /tebchan');
}, 'post');

Route::run('/tebchan');
?>