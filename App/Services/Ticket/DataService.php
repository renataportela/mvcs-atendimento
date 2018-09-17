<?php
namespace App\Services\Ticket;

use App\Models\User;
use App\Models\StatusTicket;
use App\Models\Topic;
use App\Models\Ticket;
use App\Models\TicketMessage;

class DataService
{
   public static function getTicketData($id)
   {
      $ticket = Ticket::find($id);

      $data = [
         'ticket' => $ticket->toArray(),
         'messages' => TicketMessage::listaPorTicket($id)
      ];

      return $data;
   }
}
