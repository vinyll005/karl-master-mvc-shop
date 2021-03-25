<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $arrRoutes = include_once(ROOT.'/config/routes.php');
        $this->routes = $arrRoutes;
    }

    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        $uri = $this->getURI();

        foreach($this->routes as $uriPattern => $path)  {

            if(preg_match("~^$uriPattern$~", $uri))   {

                $finalPath = preg_replace("~^$uriPattern$~", $path, $uri);

                $segments = explode('/', $finalPath);

                $controllerName = ucfirst(array_shift($segments)).'Controller';
                $controllerPath = ROOT.'/controllers/'.$controllerName.'.php';

                $actionName = 'Action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                if(file_exists($controllerPath))    {
                    include_once($controllerPath);
                }

                $controllerObject = new $controllerName;

                $actionStart = call_user_func_array(array($controllerObject, $actionName), $parameters);
                if($actionName != null) {
                    break;
                }
            }
        }
    }
}