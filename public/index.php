<?php


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\RoutePlugin;
use SONFin\ServiceContainer;
use SONFin\Plugins\ViewPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/', function (RequestInterface $request) use($app) {
    $view = $app->service('view.renderer');
    return $view->render('test.html.twig', ['name' => 'Luiz Carlos']);
});


$app->get('/home/doida', function (RequestInterface $request) {
    echo 'home doida aqui';
});


$app->get('/home/{name}/{id}', function (ServerRequestInterface $request) {
    
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write("response com emmiter do diactor");
    return $response;


//    echo 'Mostrando home';
//    echo '<br/>';
//    echo $request->getAttribute('name');
//    echo '<br/>';
//    echo $request->getAttribute('id');
});

$app->start();