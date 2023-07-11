<?php

namespace Work\Soft_Expert;

class Session {
    static public function read($property) {
        session_start();
        $token = isset($_SESSION[$property]) ? $_SESSION[$property] : null;
        session_write_close();

        return $token;
    }

    static public function write(string $property, $data): void {
        session_start();
        $_SESSION[$property] = $data;
        session_write_close();
    }
    
    static public function delete(string $property): bool {
        session_start();
        unset( $_SESSION[$property] );
        session_write_close();

        return true;
    }
}
