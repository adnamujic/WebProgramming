<?php
class RequestValidationMiddleware {
    public static function validate($required_fields, $data) {
        foreach ($required_fields as $field) {
            if (!isset($data[$field]) || empty($data[$field])) {
                Flight::halt(400, "Missing or empty field: $field");
            }
        }
    }
}
