<?php
namespace App\Services\Ticket;

use App\Models\StatusTicket;

class StatusListService
{
   public static function lista()
   {
      return StatusTicket::lista();
   }
}
