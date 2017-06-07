<?php

$app->get('/', ['Cart\Controllers\HomeController', 'index'])->setName('home');

$app->get('/products/{slug}', ['Cart\Controllers\ProductController', 'get'])->setName('product.get');

$app->get('/cart', ['Cart\Controllers\CartController', 'index'])->setName('cart.index');

$app->get('/cart/add/{slug}/{quantity}', ['Cart\Controllers\CartController', 'add'])->setName('cart.add');

$app->post('/cart/update/{slug}', ['Cart\Controllers\CartController', 'update'])->setName('cart.update');

$app->get('/order/index1', ['Cart\Controllers\OrderController', 'index1'])->setName('order.index1');

$app->get('/order/index2', ['Cart\Controllers\OrderController', 'index2'])->setName('order.index2');

$app->get('/order/index3', ['Cart\Controllers\OrderController', 'index3'])->setName('order.index3');

$app->get('/order/{hash}', ['Cart\Controllers\OrderController', 'show'])->setName('order.show');

$app->post('/order', ['Cart\Controllers\OrderController', 'create'])->setName('order.create');

$app->get('/braintree/token', ['Cart\Controllers\BraintreeController', 'token'])->setName('braintree.token');

$app->get('/cart/favorite', ['Cart\Controllers\CartController', 'favorite'])->setName('cart.favorite');

$app->get('/cart/transaction', ['Cart\Controllers\CartController', 'transaction'])->setName('cart.transaction');

$app->get('/cart/buycoin', ['Cart\Controllers\CartController', 'buycoin'])->setName('cart.buycoin');

$app->get('/cart/news', ['Cart\Controllers\CartController', 'news'])->setName('cart.news');

$app->get('/cart/checkout', ['Cart\Controllers\CartController', 'checkout'])->setName('cart.checkout');
