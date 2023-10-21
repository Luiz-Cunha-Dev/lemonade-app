<?php

namespace app\views;

/**
 * User interface, responsible for rendering html content
 * 
 * Render html pages with dynamic content
 * 
 * @package app\view
 * @since 0.1.0
 */ 
class View {


    /**
     * 
     * Standard variables
     * 
     * @var array $data default variables
     */
    private static $data = [];

    /**
     * Defines the default variables
     * 
     * @param array $vars default variables
     */
    public static function start($data = []) {
        self::$data = $data;
    }

    /**
     * Return the contents of a view
     * 
     * Files in ./pages/
     * 
     * @param string $view html page
     * @return string content of an html page
     */
    private static function getContentView($view) {
        $file = __DIR__ . '/pages/' . $view . '.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Returns a rendered view
     * 
     * Injects dynamic content into the view 
     * 
     * @param string $view view file name
     * @param (string|integer)[] $data content to be dynamically injected
     * 
     * @return string rendered page
     */
    public static function render($view, $data = []) {
        $contentView = self::getContentView($view);

        $data = array_merge(self::$data, $data);

        $keys = array_map(function($key) {
            return '{{' . $key . '}}';
        }, array_keys($data));

        return str_replace($keys, array_values($data), $contentView);

    }
}
