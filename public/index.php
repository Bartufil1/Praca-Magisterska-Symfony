<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;

use App\Controller\PasswordInLogVulnerableController;
use App\Controller\PasswordInLogSecureController;

require __DIR__ . '/../vendor/autoload.php';

// Routing
$routes = new RouteCollection();
$routes->add('login_insecure', new Route('/login-insecure', [
    '_controller' => [new PasswordInLogVulnerableController(), 'login']
], [], [], '', [], ['POST']));

$routes->add('login_secure', new Route('/login-secure', [
    '_controller' => [new PasswordInLogSecureController(), 'login']
], [], [], '', [], ['POST']));

$request = Request::createFromGlobals();
$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

try {
    $parameters = $matcher->match($request->getPathInfo());
    $controller = $parameters['_controller'];
    $response = call_user_func($controller, $request);
} catch (\Exception $e) {
    $response = new Response('Not Found', 404);
}

$response->send();
