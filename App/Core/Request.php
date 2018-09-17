<?php
namespace App\Core;

class Request implements IRequest
{
  function __construct()
  {
    $this->setRequestData();
  }

  private function setRequestData()
  {
    foreach($_SERVER as $key => $value)
    {
      $method = strtolower($key);
      $this->{$method} = $value;
    }
  }

  public function getBody()
  {
    if ($this->request_method == "POST")
    {
      $result = [];

      foreach($_POST as $key => $value)
      {
        $result[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      }

      return $result;
    }   
  }
}
