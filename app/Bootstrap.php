<?php

/**
 * @author TriNT <trint@vng.com.vn>
 */

namespace App;

use Exception;
use App\Controllers\IndexController;
use App\Controllers\ActionController;
use App\Controllers\GatewayController;

class Bootstrap {

    private static function init() {
        $router = new \AltoRouter();
        foreach (config('route') as $route) {
            $router->map($route[0], config('app.sub_domain') . $route[1], $route[2]);
        }
        
        if (is_cli()) {
            $argv  = array_slice($GLOBALS['argv'], 1);
            $match = $router->match($argv[0] ?? '');
            parse_str(implode('&', array_slice($argv, 1)), $match['params']);
        } else {
            $match = $router->match();
        }

        return $match;
    }

    public static function run() {
        $match = static::init();
        
        if (!(is_array($match) && isset($match['target']))) {
            $title = '404 Không tìm thấy';
            page_error(404, $title);
        } 
        
        $vars = $match['params'];
        if (is_array($match['target']) && count($match['target']) == 2) {
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            [$className, $func] = $match['target'];
            if (! class_exists($className)) {
                throw new Exception("Route {$uri} defined Class <b>{$className}</b> Not Found");
            }
            $access = replace_namespace_controller("{$className}@{$func}");
            $func .= 'Action';
            if (method_exists($className, $func)) {
                session_start();
                $controller = new $className;

                call_user_func_array([$controller, $func], $vars);
            } else {
                throw new Exception("Route {$uri} defined class <b>{$className}</b> does not have a method \"<b>{$func}</b>\"");
            }
        } elseif (is_callable($match['target'])) {
            call_user_func_array($match['target'], $vars);
        }
    }


    public static function noAuthencation($controller){
        $classNoAuthen = [IndexController::class,GatewayController::class];
        return in_array(get_class($controller),$classNoAuthen);

    }

}
