<?php

namespace Work\Soft_Expert\DB;

use Work\Soft_Expert\Interfaces\ModelInterface;

class Model implements ModelInterface {
    const TABLE_NAME = '';
    
    static public function get_table_name(): string {
        return static::TABLE_NAME;
    }

    static public function create(array $data, bool $return_id = false): bool {
        return DB::create(self::get_table_name(), $data, $return_id);
    }
    
    static protected function get_query_data(array $data = []): array {
        $new_query = isset($data['query']) ? $data['query'] : sprintf('SELECT * FROM %s%s', DB::PREFIX, self::get_table_name());
        
        return array_merge( $data, [ 'query' => $new_query ] );
    }
    
    static public function read(array $data = []): array {        
        return DB::read( self::get_query_data($data) );
    }
    
    static public function read_one(array $data = []): array {
        return DB::read_one( self::get_query_data($data) );
    }
    
    static public function update(array $data, array $where): bool {
        return DB::update(self::get_table_name(), $data, $where);
    }
    
    static public function delete(array $data): bool {
        return DB::delete(self::get_table_name(), $data);
    } 
}
