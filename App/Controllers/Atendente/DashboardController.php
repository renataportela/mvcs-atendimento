<?php
namespace App\Controllers\Atendente;

use \App\Core\Controller;
use App\Services\TicketsListService;
use App\Services\Ticket\StatusListService;
use App\Services\TopicsListService;

class DashboardController extends Controller
{
   public function index()
   {
      $this->response->view('atendente/dashboard', [
         'listaStatus' => StatusListService::lista(),
         'topicos' => TopicsListService::lista(),
         'initialState' => [
            'listas' => TicketsListService::listarPorStatus()
         ]
      ]);
   }

   public function formResponder($params)
   {
      $ticket_id = $params[0];
   }
}
