<?php
namespace App\Controllers;

use \App\Core\Controller;
use \App\Services\TicketService;
use \App\Services\Ticket\DataService;

class TicketController extends Controller
{
   public function newTicket($request)
   {
      $response = TicketService::register($request);

      $this->response->json($response);
   }


   public function show($params)
   {
      $ticket_id = $params[0];

      $response = DataService::getTicketData($ticket_id);

      $this->response->json($response);
   }


   public function closeTicket($request)
   {
      $response = TicketService::closeTicket($request['id']);

      $this->response->json($response);
   }
}
