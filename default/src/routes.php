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
    //Lancer ça la première fois pour qu'il crée la ou les tables
    // $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($em);
    // $classes = $em->getMetadataFactory()->getAllMetadata();
    // $schemaTool->createSchema($classes);
    //Et pis un ptit user, histoire de...
    // $em->persist(new User('bloup@mail.com', '1234'));
    // $em->flush();

    $users = $em->getRepository('simplon\entities\User')->findAll();
    
    return $response->withJson($users);

})->setName('user');


$app->get('/user/{id}', function (Request $request, Response $response, array $args) {
    $em = Connect::getInstance();

    $users = $em->getRepository('simplon\entities\User')
                ->find($args['id']);
    
    return $response->withJson($users);

})->setName('userId');

$app->post('/user', function (Request $request, Response $response, array $args) {
    $em = Connect::getInstance();
    $body = $request->getParsedBody();
    $user = new User($body['email'], $body['pass']);
    $em->persist($user);
    $em->flush();
    
    return $response->withJson($user);

})->setName('user');

$app->put('/user', function (Request $request, Response $response, array $args) {
    $em = Connect::getInstance();
    $body = $request->getParsedBody();
    $user = new User($body['email'], $body['pass'], $body['id']);
    $em->merge($user);
    $em->flush();
    
    return $response->withJson($user);

})->setName('user');

$app->delete('/user/{id}', function (Request $request, Response $response, array $args) {
    $em = Connect::getInstance();
    
    $user = $em->getRepository('simplon\entities\User')
                ->find($args['id']);
    $em->remove($user);
    $em->flush();
    
    return $response->withJson($user);

})->setName('user');