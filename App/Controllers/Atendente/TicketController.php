<?php
namespace App\Controllers\Atendente;

use \App\Core\Controller;
use App\Services\TicketService;
use App\Services\TicketsListService;

class TicketController extends Controller
{
   public function index()
   {
      $this->response->json([
         'listas' => TicketsListService::listarPorStatus()
      ]);
   }

   public function update($request)
   {
      $response = TicketService::updateTicket($request);

      $this->response->json($response);
   }
}
