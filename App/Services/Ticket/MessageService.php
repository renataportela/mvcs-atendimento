<?php
namespace App\Services\Ticket;

use \App\Factories\TicketMessageFactory;
use \App\Models\Ticket;
use \App\Models\StatusTicket;

class MessageService
{
   public static function create($fields)
   {
      try{
         $message = TicketMessageFactory::create($fields);
         $message->save();

         $ticket = Ticket::find($message->ticket->id);
         $status_id = StatusTicket::RESPONDIDOS;

         // Mock - verificação do usuário logado
         if (isset($_SESSION['cliente']) and $_SESSION['cliente'] == $_SESSION['user']){
            $status_id = StatusTicket::AGUARDANDO_ATENDIMENTO;
         }

         $ticket->status->id = $status_id;
         $ticket->update();

         return [
            'status' => 'success',
            'message' => 'Mensagem registrada com sucesso.'
         ];
      }
      catch (\Exception $error){
         header("HTTP/1.0 400 Bad Request");
         return [
            'status' => 'danger',
            'message' => $error->getMessage()
         ];
      }
   }
}
