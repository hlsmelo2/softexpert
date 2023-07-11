<?php

namespace Work\Soft_Expert\Interfaces;

interface ModelInterface {
    static function create(array $data, bool $return_id): bool;
    static function read(array $data): array;
    static function update(array $data, array $where): bool | int;    
    static function delete(array $data): bool;
}
