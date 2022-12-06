<?php
/**
 * Class Request: Copy from a course Programming BTI7054
 * Merge all requests (GET, POST) together
 * save as array easy to use in controllers
 */

class Request {
    private $parameters = array();

    public function __construct() {
            $this->parameters = array_merge($_GET, $_POST);
    }

    public function isParameter($parameter) {
        return isset($this->parameters[$parameter]);
    }

    public function getValue($parameter, $default='') {
        if (!$this->isParameter($parameter)) {
            return $default;
        } else {
            return $this->parameters[$parameter];
        }
    }
}