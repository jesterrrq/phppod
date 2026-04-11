<?php
class Route
{
    static function getRoute($route)
    {
        if($route === '/myserver/get')
            require 'get.php';
        elseif($route === '/myserver/post')
            require 'post.php';
        elseif($route === '/myserver/test')
            require 'test.php';
        else
            require '404.php';
    }
}