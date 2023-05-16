<?php
class Router
{
    private $routes = array();

    public function addRoute($url, $handler)
    {
        $this->routes[$url] = $handler;
    }

    public function route($url)
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        if (array_key_exists($url, $this->routes)) {
            $handler = $this->routes[$url];
            $handler();
        } else {
            echo "404";
            header("refresh:1; url=/home");
            exit();
        }
    }
}


/*

GET / SWITCH verzió az útvonal kezelésre

$site = '';
if(isset($_GET['s']))
$site = isset($_GET['s'];

switch ($site) {
    case 'fooldal':
        require_once 'index.php';
        break;
    case 'login':
        require_once 'login.php';
        break;
    default:
        require_once 'index.php';
        break;
}
*/