<?php
namespace App\Controllers;

use \App\Core\Controller;
use \App\Services\Ticket\MessageService;

class TicketMessageController extends Controller
{
   public function save($request)
   {
      $response = MessageService::create($request);

      $this->response->json($response);
   }
}
