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
    private $routes;

    public function __construct()
    {
        $request = Request::createFromGlobals();

        $this->routes = new RouteCollection();

        $this->getRoutes();

        $context = new RequestContext();
        $matcher = new UrlMatcher($this->routes, $context);

        $controllerResolver = new ControllerResolver();
        $argumentResolver = new ArgumentResolver();

        $bootstrap = new Bootstrap($matcher, $controllerResolver, $argumentResolver);
        $response = $bootstrap->handle($request);

        $response->send();
    }

    private function getRoutes()
    {
        $this->routes->add('home_page', new Route('/', [
          '_controller' => 'App\HomeController::index',
        ]));

        $this->routes->add('all_products', new Route('/products', [
          '_controller' => 'App\ProductController::showAll',
        ]));

        $this->routes->add('product_create', new Route('/product/create', [
          '_controller' => 'App\ProductController::create',
        ]));

        $this->routes->add('product_create_post', new Route('/product/create/post', [
          '_controller' => 'App\ProductController::createPost',
        ]));

        $this->routes->add('product_move', new Route('/product/move', [
          '_controller' => 'App\ProductController::move',
        ]));

        $this->routes->add('product_move_post', new Route('/product/move/post', [
          '_controller' => 'App\ProductController::movePost',
        ]));
    }
}
