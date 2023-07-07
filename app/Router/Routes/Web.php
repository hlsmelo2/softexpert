<?php

namespace Work\Soft_Expert\Router\Routes;

class Web{
    const routes = [
        [
            Constants::PATH => '/',
            Constants::DESTINATION => 'home.php.pug',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/home',
            Constants::DESTINATION => 'home.php.pug',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/login',
            Constants::DESTINATION => 'login.php.pug',
            Constants::METHOD => Constants::GET,
        ],
        [
            Constants::PATH => '/register/products',
            Constants::DESTINATION => 'register/product.php.pug',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/register/product-types',
            Constants::DESTINATION => 'register/product-types.php.pug',
            Constants::METHOD => Constants::GET, 
            Constants::PROTECTED => Constants::DEFAULT,   
        ],
        [
            Constants::PATH => '/register/taxes',
            Constants::DESTINATION => 'register/taxes.php.pug',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        // [
        //     Constants::PATH => '/product/{product_id}',
        //     Constants::DESTINATION => 'product.php.pug',
        //     Constants::METHOD => Constants::GET,
        // ],
        [
            Constants::PATH => '/buy',
            Constants::DESTINATION => 'buy.php.pug',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
    ];
}
