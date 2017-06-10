<?php


use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;
use SONFin\Application;
use SONFin\Plugins\RoutePlugin;
use SONFin\ServiceContainer;
use SONFin\Plugins\ViewPlugin;
use SONFin\Plugins\DbPlugin;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

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

$app->get('/category-costs2', function() use($app){
	$view = $app->service('view.renderer');
	return $view->render('category-costs/list.html.twig');

});


$app->get('/category-costs', function() use($app){
	$view = $app->service('view.renderer');
	$meuModel = new \SONFin\Models\CategoryCost();
	$categories = $meuModel->all();

	return $view->render('category-costs/list.html.twig',[
		'categories' => $categories
	]);

});


$app->get('/category-costs/new', function() use($app){
	$view = $app->service('view.renderer');
	return $view->render('category-costs/create.html.twig');

});



//    echo 'Mostrando home';
//    echo '<br/>';
//    echo $request->getAttribute('name');
//    echo '<br/>';
//    echo $request->getAttribute('id');

$app->start();