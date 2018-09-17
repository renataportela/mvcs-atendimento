<?php
namespace App\Factories;

use App\Models\User;
use App\Models\Ticket;
use App\Models\TicketMessage;

abstract class TicketMessageFactory
{
   //
   public static function create($fields)
   {
      extract($fields);

      if (! isset($_SESSION['user']) or empty($_SESSION['user']))
      {
        throw new \Exception("Para registrar um ticket, é ncessário estar logado.");
      }
      elseif (empty($ticket_id))
      {
         throw new \Exception("Por favor, informe o ticket.");
      }
      elseif (empty($message))
      {
         throw new \Exception("Por favor, informe a mensagem.");
      }
      else
      {
         $user = User::find($_SESSION['user']);
         $ticket = Ticket::find($ticket_id);

         $ticketMessage = new TicketMessage($ticket, $user);
         $ticketMessage->message    = $message;
         $ticketMessage->created_at = date('Y-m-d H:i:s');

         return $ticketMessage;
      }
   }
}
