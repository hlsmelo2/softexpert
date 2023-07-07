<?php

namespace Work\Soft_Expert\DB;

use Doctrine\DBAL\DriverManager;

class DB {
    const PREFIX = 'se_';
    const ID_KEY = 'id';

    static protected $connection = null;

    static protected function get_connection() {
        ini_set('display_errors', 1);
        if (self::$connection !== null) {
            return self::$connection;
        }

        require_once __DIR__ . '/config.php';
        self::$connection = DriverManager::getConnection(CONNECTION_DATA);
        
        return self::$connection;
    }
    
    static public function execute(string $query) {
        $prepare = self::get_connection()->prepare($query);
        $execute = $prepare->executeQuery();
        
        return $execute->fetchAllAssociative();
    }
    
    static public function create(string $table_name, array $data) {
        return self::get_connection()->insert(self::PREFIX . $table_name, $data);
    }
    
    static public function read(string $query): array {
        return self::get_connection()->fetchAllAssociative($query);
    } 
    
    static public function update(string $table_name, array $data) {
        unset($data[self::ID_KEY]);

        return self::get_connection()->update(self::PREFIX . $table_name, $data);
    }
    
    static public function delete(string $table_name, array $data) {
        return self::get_connection()->delete(self::PREFIX . $table_name, $data);
    }    
}
