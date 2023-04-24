<?php

namespace Core;

class Dispatcher
{
    public function getPage(Track $track)
    {
        $class_name = ucfirst($track->controller).'Controller';
        $full_name = "\\Project\\Controlles\\$class_name";

        try {
            $controller = new $full_name;
            if(method_exists($controller, $track->action)) {
                $result = $controller->{$track->action}($track->params);

                if($result) {
                    return $result;
                } else {
                    return new Page('default');
                }
            } else {
                echo "Метод <b>{$track->action}</b> не найден в классе $full_name."; die();
            }
        } catch(\Exception $error) {
            echo $error->getMessage();die();
        }
    }

}