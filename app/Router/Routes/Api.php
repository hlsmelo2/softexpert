<?php

namespace Work\Soft_Expert\Router\Routes;

use Work\Soft_Expert\Api as ApiHandler;

class Api {
    const routes = [
        [
            Constants::PATH => '/api/products',
            Constants::DESTINATION => ApiHandler::class . '::get_products',
            Constants::METHOD => Constants::GET,
        ],
        [
            Constants::PATH => '/api/product',
            Constants::DESTINATION => ApiHandler::class . '::register_product',
            Constants::METHOD => Constants::POST,
        ],
        [
            Constants::PATH => '/api/product-types',
            Constants::DESTINATION => ApiHandler::class . '::get_product_types',
            Constants::METHOD => Constants::GET,
        ],
        [
            Constants::PATH => '/api/product-type',
            Constants::DESTINATION => ApiHandler::class . '::register_product_type',
            Constants::METHOD => Constants::POST,
        ],
        [
            Constants::PATH => '/api/taxes',
            Constants::DESTINATION => ApiHandler::class . '::get_taxes',
            Constants::METHOD => Constants::GET,
        ],
        [
            Constants::PATH => '/api/tax',
            Constants::DESTINATION => ApiHandler::class . '::register_tax',
            Constants::METHOD => Constants::POST,
        ],
        [
            Constants::PATH => '/api/sale',
            Constants::DESTINATION => ApiHandler::class . '::register_sale',
            Constants::METHOD => Constants::POST,
        ],        
    ];
}
