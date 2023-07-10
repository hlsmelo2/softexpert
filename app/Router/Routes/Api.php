<?php

namespace Work\Soft_Expert\Router\Routes;

use Work\Soft_Expert\Api as ApiHandler;

class Api {
    const routes = [
        [
            Constants::PATH => '/api/products',
            Constants::DESTINATION => ApiHandler::class . '::get_products',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,

        ],
        [
            Constants::PATH => '/api/product',
            Constants::DESTINATION => ApiHandler::class . '::register_product',
            Constants::METHOD => Constants::POST,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/product/{product_id}',
            Constants::DESTINATION => ApiHandler::class . '::get_product',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/product-types',
            Constants::DESTINATION => ApiHandler::class . '::get_product_types',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/product-type',
            Constants::DESTINATION => ApiHandler::class . '::register_product_type',
            Constants::METHOD => Constants::POST,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/taxes',
            Constants::DESTINATION => ApiHandler::class . '::get_taxes',
            Constants::METHOD => Constants::GET,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/tax',
            Constants::DESTINATION => ApiHandler::class . '::register_tax',
            Constants::METHOD => Constants::POST,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/sale',
            Constants::DESTINATION => ApiHandler::class . '::register_sale',
            Constants::METHOD => Constants::POST,
            Constants::PROTECTED => Constants::DEFAULT,
        ],
        [
            Constants::PATH => '/api/user',
            Constants::DESTINATION => ApiHandler::class . '::register_user',
            Constants::METHOD => Constants::POST,
        ],
        [
            Constants::PATH => '/api/login',
            Constants::DESTINATION => ApiHandler::class . '::login',
            Constants::METHOD => Constants::POST,
        ],
    ];
}
