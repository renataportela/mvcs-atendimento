<?php
namespace App\Core;

class Router
{
  private $request;

  function __construct(IRequest $request)
  {
     $this->request = $request;
  }

  function __call($methodName, $args)
  {
    list($route, $controllerMethod) = $args;
    $this->{strtolower($methodName)}[$this->formatRoute($route)] = $controllerMethod;
  }

  private function formatRoute($route)
  {
    $result = rtrim($route, '/');

    if ($result === '') return '/';

    return $result;
  }

  function resolve()
  {
    $httpMethod = $this->{strtolower($this->request->request_method)};
    $route = $this->formatRoute($this->request->request_uri);
    $controllerMethod = null;
    $params = [];

    // Rota encontrada
    if (isset($httpMethod[$route])){
      $controllerMethod = $httpMethod[$route];
    }
    // A rota tem parâmetros, ou não existe
    else{
      $uris = explode('/', trim($route, '/'));
      $total = sizeof($uris);
      $last = $total -1;

      while ($last > 0 and $controllerMethod == null)
      {
         $params[] = $uris[$last];
         $uris[$last] = '{:param}';

         $url = '/'.join('/', $uris);

         if (isset($httpMethod[$url])){
           $controllerMethod = $httpMethod[$url];
         }

         $last--;
      }
    }

    if (is_null($controllerMethod))
    {
      header('HTTP/1.0 404 Not Found');
      return;
    }

    $parts = explode('@', $controllerMethod);
    $controllerClass = 'App\Controllers\\'.$parts[0];
    $controllerMethod = $parts[1];

    $controller = new $controllerClass;

    if ($this->request->request_method == 'POST'){
      $controller->{$controllerMethod}($this->request->getBody());
    }
    else{
     $controller->{$controllerMethod}($params);
    }
  }

  function __destruct()
  {
    $this->resolve();
  }
}
