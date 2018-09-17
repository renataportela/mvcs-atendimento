<?php
namespace App\Controllers;

use \App\Core\Controller;
use \App\Services\ContactService;

class ContactController extends Controller
{
   public function save($request)
   {
      $response = ContactService::saveNewContact($request);

      $this->response->json($response);
   }
}
