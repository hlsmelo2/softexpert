<?php

namespace Work\Soft_Expert\DB\Models;

use Work\Soft_Expert\DB\DB;

class Product {
    const TABLE_NAME = 'products';
    const DEFAULT_IMAGE = '';

    static public function read($params): array {
        $query = 'SELECT * FROM se_products';

        if ( ! isset($params['full']) ) {
            return DB::read($query);
        }
        
        $full_query = (
            'SELECT p.id, p.name, p.description, p.image, p.quantity, p.price,
            t.name type_name, x.name tax_name, x.value tax
            FROM se_products p, se_product_types t, se_taxes x
            WHERE t.tax_id = x.id AND p.product_type_id = t.id'
        );
        
        return DB::read($full_query);
    }
    
    static protected function get_image_paths(): object | string {
        if (count($_FILES) === 0) {
            return self::DEFAULT_IMAGE;
        }

        $image = $_FILES['image_file'];
        $file_url = '/public/assets/images/' . $image['name'];
        $filename = __DIR__ . '/../../..' . $file_url;
        
        return (object) [
            'tmp_name' => $image['tmp_name'],
            'name' => $filename,
            'url' => $file_url,
        ];
    }

    static public function create(array $data) {
        $paths = self::get_image_paths();
        $data['image'] = ($paths === '') ? '' : $paths->url;
        unset($data['image_file']);

        if ($paths === '') {
            return DB::create(self::TABLE_NAME, $data);
        }

        return (
            ( move_uploaded_file($paths->tmp_name, $paths->name) ) &&
            DB::create(self::TABLE_NAME, $data)
        );
    }
    
    static public function update(array $data) {
        DB::create(self::TABLE_NAME, $data);
    }
    
    static public function delete(array $data) {
        DB::delete(self::TABLE_NAME, $data);
    }
}
