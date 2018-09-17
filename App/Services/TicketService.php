<?php
namespace App\Services;

use \App\Factories\TicketFactory;
use \App\Models\Ticket;
use \App\Models\StatusTicket;

class TicketService
{
   public static function create($fields)
   {
      try{
         $ticket = TicketFactory::create($fields);
         $ticket->save();

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

   public static function updateTicket($fields)
   {
      try{
         $ticket = Ticket::find($fields['ticket_id']);
         $ticket->topic->id = $fields['topic_id'];
         $ticket->status->id = $fields['status_id'];
         $ticket->update();

         return [
            'status' => 'success',
            'message' => 'Chamado atualizado com sucesso.'
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

   public static function closeTicket($id)
   {
      try{
         $ticket = Ticket::find($id);
         $ticket->status->id = StatusTicket::ENCERRADOS;
         $ticket->update();

         return [
            'status' => 'success',
            'message' => 'Chamado encerrado com sucesso.'
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
