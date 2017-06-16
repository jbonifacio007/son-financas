<?php


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\RoutePlugin;
use SONFin\ServiceContainer;
use SONFin\Plugins\ViewPlugin;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\AuthPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

/*
$app->get('/{name}', function (ServerRequestInterface $request) use($app) {
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => $request->getAttribute('name')]);
});


$app->get('/home/doida', function (RequestInterface $request) {
    echo 'home doida aqui';
});


$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write("response com emmiter do diactor");
    return $response;
});
*/



require_once __DIR__ . '/../src/controllers/category-costs.php';
require_once __DIR__ . '/../src/controllers/users.php';
require_once __DIR__ . '/../src/controllers/auth.php';


//    echo 'Mostrando home';
//    echo '<br/>';
//    echo $request->getAttribute('name');
//    echo '<br/>';
//    echo $request->getAttribute('id');

$app->start();