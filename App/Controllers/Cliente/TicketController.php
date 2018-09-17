<?php
namespace App\Controllers\Cliente;

use \App\Core\Controller;
use App\Services\TicketService;
use App\Services\TicketsListService;

class TicketController extends Controller
{
   public function index()
   {
      $lista = TicketsListService::listaTicketsDoCliente($_SESSION['user']);
      $this->response->json($lista);
   }

   public function create($request)
   {
      $response = TicketService::create($request);

      $this->response->json($response);
   }
}
