<?php

namespace Cart\Controllers;

use Slim\Router;
use Slim\Views\Twig;
use Cart\Basket\Basket;
use Cart\Models\Product;
use Cart\Basket\Exceptions\QuantityExceededException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class CartController{
  protected $basket;
  protected $product;
  public function __construct(Basket $basket, Product $product)
  {
      $this->basket = $basket;
      $this->product = $product;
  }

  public function index(Request $request, Response $response, Twig $view)
  {
      $this->basket->refresh();
      return $view->render($response, 'cart/index.twig');
  }

  public function add($slug, $quantity, Request $request, Response $response, Router $router)
  {
      $product = $this->product->where('slug', $slug)->first();

      if (!$product){
          return $response->withRedirect($router->pathFor('home'));
      }

      try {
          $this->basket->add($product, $quantity);
      } catch(QuantityExceededException $e) {
        //
      }
      return $response->withRedirect($router->pathFor('cart.index'));
  }

  public function update($slug, Request $request, Response $response, Router $router)
  {
      $product = $this->product->where('slug', $slug)->first();

      if (!$product){
          return $response->withRedirect($router->pathFor('home'));
      }

      try {
          $this->basket->update($product, $request->getParam('quantity'));
      } catch(QuantityExceededException $e) {
        //
      }
      return $response->withRedirect($router->pathFor('cart.index'));
  }

  public function favorite(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'cart/favorite.twig');
  }

  public function transaction(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'cart/transaction.twig');
  }

  public function buycoin(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'cart/buycoin.twig');
  }

  public function news(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'cart/news.twig');
  }

  public function checkout(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'cart/checkout.twig');
  }
}
