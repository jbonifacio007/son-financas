<?php

use Psr\Http\Message\ServerRequestInterface;
use SONFin\Models\CategoryCost;

$app

    ->get('/category-costs2', function() use($app){
        $view = $app->service('view.renderer');
        return $view->render('category-costs/list.html.twig');

    })

  ->get('/category-costs3', function() use($app){
        $view = $app->service('view.renderer');
        $meuModel = new \SONFin\Models\CategoryCost();
        $categories = $meuModel->all();

        return $view->render('category-costs/list.html.twig',[
            'categories' => $categories
        ]);

    },'category-costs.list3')



  ->get('/category-costs', function() use($app){
        $view = $app->service('view.renderer');

        $repository = $app->service('repository.factory')->factory(CategoryCost::class);
        $categories = $repository->all();
        
        return $view->render('category-costs/list.html.twig',[
            'categories' => $categories
        ]);

    },'category-costs.list')


  ->get('/category-costs/new', function() use($app){
        $view = $app->service('view.renderer');
        return $view->render('category-costs/create.html.twig');

    },'category-costs.new')

  ->post('/category-costs/store', function (ServerRequestInterface $request) use ($app){
        $data = $request->getParsedBody();
        \SONFin\Models\CategoryCost::create($data);
        return $app->route('category-costs.list');

    },'category-costs.store')

  ->get('/category-costs/{id}/edit', function( ServerRequestInterface $request) use($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = \SONFin\Models\CategoryCost::findOrFail($id);

        return $view->render('category-costs/edit.html.twig',[
            'category' => $category
        ]);

    },'category-costs.edit')

  ->post('/category-costs/{id}/update', function( ServerRequestInterface $request) use($app){
        $id = $request->getAttribute('id');
        $category = \SONFin\Models\CategoryCost::findOrFail($id);
        $data = $request->getParsedBody();
        $category->fill($data);
        $category->save();
        return $app->route('category-costs.list');

    },'category-costs.update')
    
    ->get('/category-costs/{id}/show', function(ServerRequestInterface $request) use($app){
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = \SONFin\Models\CategoryCost::findOrFail($id);
        return $view->render('category-costs/show.html.twig', [
            'category' => $category
        ]);
    }, 'category-costs.show')

    ->get('/category-costs/{id}/delete', function(ServerRequestInterface $request) use($app){
        $id = $request->getAttribute('id');
        $category = \SONFin\Models\CategoryCost::findOrFail($id);
        $category->delete();
        return $app->route('category-costs.list');
    }, 'category-costs.delete')
    
  ;
