<?php
namespace App\Core;

class Controller
{
   protected $response;

   public function __construct()
   {
      $this->response = new Response();
   }
}
