<?php

class Logger {
    public static function log($message) {
        $file = __DIR__ . '/../logs/app.log';
        $entry = "[" . date('Y-m-d H:i:s') . "] " . $message . PHP_EOL;
        file_put_contents($file, $entry, FILE_APPEND);
    }
}
