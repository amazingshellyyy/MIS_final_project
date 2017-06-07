<?php

namespace Cart\Controllers;

use Braintree_ClientToken;
use Psr\Http\Message\ResponseInterface as Response;

class BraintreeController{
  //response with Json, pick up with AJAX request
  public function token(Response $response)
  {
    return $response->withJson([
      'token' => Braintree_ClientToken::generate(),
    ]);
  }

}
