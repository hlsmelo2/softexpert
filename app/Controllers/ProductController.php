<?php

namespace Work\Soft_Expert\Controllers;

use Work\Soft_Expert\DB\Models\Product;

class ProductController {
    const DEFAULT_IMAGE = '';
    const IMAGES_PATH = '/public/assets/images/';
    const PRODUCT_IMAGE_SAMPLE = 'product-image-sample.png';

    static protected function get_full_query(array $where = []): string {
        $where_tail = [];

        foreach ($where as $key => $value) {
            array_push( $where_tail, sprintf(' AND %s = %s', $key, $value) );
        }

        return (
            'SELECT p.id, p.name, p.description, p.image, p.quantity, p.price,
            t.name type_name, x.name tax_name, x.value tax
            FROM se_products p, se_product_types t, se_taxes x
            WHERE t.tax_id = x.id AND p.product_type_id = t.id' . implode('', $where_tail)
        );
    }

    static public function get($params): array {
        $id = $params['product_id'][0];
        $query = self::get_full_query( [ 'p.id' => $id ] );

        return Product::read_one([ 'query' => $query ] );
    }
    
    static public function read($params): array {
        if ( ! isset($params['full']) || $params['full'] === 0 ) {
            return Product::read();
        }
        
        return Product::read( ['query' => self::get_full_query()] );
    }
    
    static protected function get_image_paths(): object | string {
        if (count($_FILES) === 0) {
            return self::DEFAULT_IMAGE;
        }

        $image = $_FILES['image_file'];
        $file_url = self::IMAGES_PATH . $image['name'];
        $filename = __DIR__ . '/../../..' . $file_url;
        
        return (object) [
            'tmp_name' => $image['tmp_name'],
            'name' => $filename,
            'url' => $file_url,
        ];
    }

    static public function create(array $data) {
        $paths = self::get_image_paths();
        $data['image'] = ($paths === '') ? self::IMAGES_PATH . self::PRODUCT_IMAGE_SAMPLE : $paths->url;
        unset($data['image_file']);

        if ($paths === '') {
            return Product::create($data);
        }

        return (
            ( move_uploaded_file($paths->tmp_name, $paths->name) ) &&
            Product::create($data)
        );
    }
}
