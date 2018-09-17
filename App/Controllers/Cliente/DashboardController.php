<?php
namespace App\Controllers\Cliente;

use \App\Core\Controller;
use App\Services\TicketsListService;
use App\Services\TopicsListService;

class DashboardController extends Controller
{
   public function index()
   {
      $this->response->view('cliente/dashboard', [
         'initialState' => TicketsListService::listaTicketsDoCliente($_SESSION['user']),
         'topicos'      => TopicsListService::lista()
      ]);
   }
}
