<?php

namespace Src;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Routing
{
    private $request;
    private $routes;
    private $context;
    private $matcher;
    private $controllerResolver;
    private $argumentResolver;
    private $bootstrap;
    private $response;

    public function __construct()
    {
        $this->request = Request::createFromGlobals();

        $this->routes = new RouteCollection();

        $this->getRoutes();

        $this->context = new RequestContext();
        $this->matcher = new UrlMatcher($this->routes, $this->context);

        $this->controllerResolver = new ControllerResolver();
        $this->argumentResolver = new ArgumentResolver();

        $this->bootstrap = new Bootstrap($this->matcher, $this->controllerResolver, $this->argumentResolver);
        $this->response = $this->bootstrap->handle($this->request);

        $this->response->send();
    }

    private function getRoutes()
    {
        $this->routes->add('product_create', new Route('/product/create', [
          '_controller' => 'App\ProductController::create',
        ]));

        $this->routes->add('product_move', new Route('/product/move', [
          '_controller' => 'App\ProductController::move',
        ]));
    }
}
