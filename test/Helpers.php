<?php

namespace Test;

class Helpers {
    static public function callMethod($obj, $name, array $args) {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }

    static public function json_parse(string $json): array {
        return json_decode($json, true);
    }
    
    static public function get_money_increment(string $float_value, int $increment): string{
        $float_value += ($increment/100);

        return preg_replace('/\./', ',', $float_value);
    }
}