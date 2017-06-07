<?php

namespace Cart\Controllers;

use Slim\Router;
use Slim\Views\Twig;
use Cart\Basket\Basket;
use Cart\Models\Order;
use Cart\Models\Product;
use Cart\Models\Customer;
use Cart\Validation\Forms\OrderForm;
use Cart\Validation\Contracts\ValidatorInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Braintree_Transaction;

class OrderController{

  protected $basket;
  protected $router;
  protected $validator;

  public function __construct(Basket $basket, Router $router, ValidatorInterface $validator)
  {
      $this->basket = $basket;
      $this->router = $router;
      $this->validator = $validator;
  }

  public function index1(Request $request, Response $response, Twig $view)
  {
      // $this->basket->refresh();
      //
      // if(!$this->basket->subTotal()){
      //     return $response->withRedirect($this->router->pathFor('cart.index'));
      // }
      return $view->render($response, 'order/index1.twig');
  }

  public function index2(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'order/index2.twig');
  }

  public function index3(Request $request, Response $response, Twig $view)
  {
      return $view->render($response, 'order/index3.twig');
  }

  public function show($hash, Request $request, Response $response, Twig $view, Order $order)
  {
    $order = $order->with(['products'])->where('hash', $hash)->first();
    if (!order) {
      return $response->withRedirect($this->router->pathFor('home'));
    }
    return $view->render($response, 'order/show.twig', [
      'order' => $order,
    ]);
  }

  public function create(Request $request, Response $response, Customer $customer)
  {
      $this->basket->refresh();
      if (!$this->basket->subTotal()){
        return $response->withRedirect($this->router->pathFor('cart.index'));
      }

      if (!$request->getParam('payment_method_nonce')) {
        return $response->withRedirect($this->router->pathFor('order.index1'));
      }

      //validate
      $validation = $this->validator->validate($request, OrderForm::rules());

      if($validation->fails()){
          return $response->withRedirect($this->router->pathFor('order.index1'));
      }

      $hash = bin2hex(random_bytes(32));

      $customer = $customer->firstOrCreate([
        'email' => $request->getParam('email'),
        'name' => $request->getParam('name'),
      ]);

      $order = $customer->orders()->create([
          'hash' => $hash,
          'paid' => false,
          'total' => $this->basket->subTotal() + 5,
      ]);

      $order->products()->saveMany(
        $this->basket->all(),
        $this->getQuantities($this->basket->all())
      );

      //charge & payments
      $result = Braintree_Transaction::sale([
        'amount' => $this->basket->subTotal() + 5,
        'paymentMethodNonce' => $request->getParam('payment_method_nonce'),
        'options' => [
          'submitForSettlement' => true,
        ]
      ]);

      $event = new \Cart\Events\OrderWasCreated($order, $this->basket);

      if(!$result->success){
        $event->attach(new \Cart\Handlers\RecordFailedPayment);
        $event->dispatch();

        return $response->withRedirect($this->router->pathFor('order.index1'));
      }

      $event->attach([
        new \Cart\Handlers\MarkOrderPaid,
        new \Cart\Handlers\RecordSuccessfulPayment($result->transaction->id),
        new \Cart\Handlers\UpdateStock,
        new \Cart\Handlers\EmptyBasket,
      ]);
      $event->dispatch();

      return $response->withRedirect($this->router->pathFor('order.show', [
        'hash' => $hash,
      ]));
  }

    protected function getQuantities($items)
    {
        $quantities = [];
        foreach ($items as $item) {
          $quantities[] = ['quantity' => $item->quantity];
        }
        return $quantities;
    }
}
