<?php
namespace libs;

class Common {
    public static function get_query(String $key) {
        // Map queries to object
        $queries = array();
        parse_str(parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY), $queries);
        $queries = (object) $queries;

        // Get query "q"
        $value = "";
        if(property_exists($queries, $key)) {
            $value = $queries->$key;
        }
        return $value;
    }
}