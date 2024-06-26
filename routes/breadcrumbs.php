<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

/**
 * Home
 */
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

/**
 * Home > [Post]
 */
Breadcrumbs::for('product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('home')->push($product->name, route('product.show', $product));
});
