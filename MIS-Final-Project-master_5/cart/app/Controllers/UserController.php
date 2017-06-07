<?php

namespace Cart\Controllers;

use Slim\Router;
use Slim\Views\Twig;
use Cart\Models\User;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{
  public function get($slug, Request $request, Response $response, Twig $view, Router $router, User $user)
  {
      $product = $product->where('slug', $slug)->first();

      if(!$product){
          return $response->withRedirect($router->pathFor('home'));
      }

      return $view->render($response, 'products/product.twig', [
          'product' => $product,
      ]);
  }

}
