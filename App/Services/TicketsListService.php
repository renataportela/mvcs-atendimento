<?php
namespace App\Services;

use App\Models\Ticket;

class TicketsListService
{
   public static function listaTicketsDoCliente($id)
   {
      $result = Ticket::listaDoCliente($id);

      return [
         'lista' => $result,
         'total' => sizeof($result)
      ];
   }

   public static function listarPorStatus()
   {
      $result = Ticket::listaPorStatus();

      $retorno = $listas = [];

      if (! empty($result)){
         foreach ($result as $row){
            $listas[$row['status_id']][] = $row;
         }
      }

      foreach ($listas as $status => $lista){
         $retorno[$status] = [
            'lista' => $lista,
            'total' => sizeof($lista)
         ];
      }

      return $retorno;
   }
}
