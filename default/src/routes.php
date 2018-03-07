<?php

use Slim\Http\Request;
use Slim\Http\Response;

use simplon\dao\Connect;
use simplon\entities\User;

// Routes

$app->get('/', function (Request $request, Response $response, array $args) {


    // Render index view
    return $this->view->render($response, 'index.twig', [

    ]);
})->setName('index');

$app->get('/example', function (Request $request, Response $response, array $args) {
    
    return $response->withJson(['ga', 'zo', 'bu', 'meu']);

})->setName('example');

$app->get('/user', function (Request $request, Response $response, array $args) {
    $em = Connect::getInstance();

    $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
    $classes = $em->getMetadataFactory()->getAllMetadata();
    $schemaTool->createSchema($classes);

    $em->persist(new User('bloup@mail.com', '1234'));
    $em->flush();

    var_dump($em->find('simplon\entities\User', 1));

    return $response->withJson(['ga', 'zo', 'bu', 'meu']);

})->setName('user');