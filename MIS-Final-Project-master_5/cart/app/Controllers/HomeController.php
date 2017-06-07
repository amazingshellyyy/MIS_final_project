<?php

namespace Cart\Controllers;

use Slim\Views\Twig;
use Cart\Models\Product;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;

class HomeController{

  public $products;
  public function index(Request $request, Response $response, Twig $view, Product $product){
    // $products = $product->get();

    // get query in Slim 3
    $query = $request->getQueryParam("query");

    if(!empty($query))
    {
      // get the products related to query
      $products = Product::where('title', 'LIKE', '%'.$query.'%')
      ->orwhere('description', 'LIKE', '%'.$query.'%')
      ->orwhere('tag1', 'LIKE', '%'.$query.'%')
      ->orwhere('tag2', 'LIKE', '%'.$query.'%')
      ->orwhere('tag3', 'LIKE', '%'.$query.'%')
      ->orwhere('tag4', 'LIKE', '%'.$query.'%')
      ->orwhere('tag5', 'LIKE', '%'.$query.'%')
      ->get();
    }


    // search for results matching provider or project
    $userName = $request->getQueryParam("userName");
    $projectName = $request->getQueryParam("projectName");
    if(!empty($projectName) && !empty($userName))
    {
      $products = Product::where('userName', 'LIKE', '%'.$userName.'%')
      ->where('projectName', 'LIKE', '%'.$projectName.'%')
      ->get();
    } else if(!empty($userName)) {
      $products = Product::where('userName', 'LIKE', '%'.$userName.'%')->get();
    } else if(!empty($projectName)) {
      $products = Product::where('projectName', 'LIKE', '%'.$projectName.'%')->get();
    }

    $countQuery = $products->count();

    return $view->render($response, 'home.twig', [
      'products' => $products,
      'query' => $query,
      'userName' => $userName,
      'countQuery' => $countQuery,
    ]);
  }

}
