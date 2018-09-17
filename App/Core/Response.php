<?php
namespace App\Core;

class Response
{
   public function view($viewFile, $data = [])
   {
      extract($data);

      require dirname(__DIR__) . "/Views/layout/layout.php";
   }

   public function json($data)
   {
     header('Content-Type: application/json');
     echo json_encode($data);
   }
}
