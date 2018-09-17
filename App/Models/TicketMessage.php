<?php
namespace App\Models;

use App\Core\Model;
use App\Models\Ticket;
use App\Models\User;

class TicketMessage extends Model
{
   protected $tableName = 'ticket_messages';
   protected $primaryKey = 'id';

   public $id;
   public $ticket;
   public $user;
   public $message;
   public $created_at;

   public function __construct(Ticket $ticket, User $user)
   {
      $this->ticket = $ticket;
      $this->user = $user;
   }

   public function save()
   {
      $this->db()->insert($this->tableName, [
         'user_id'    => $this->user->id,
         'ticket_id'  => $this->ticket->id,
         'message'    => $this->message,
         'created_at' => $this->created_at
      ]);
   }

   public static function listaPorTicket($id)
   {
      return parent::db()->sqlSelect(
         "SELECT ticket_messages.*, users.name AS user_name,
            DATE_FORMAT(ticket_messages.created_at, '%d/%m/%Y %H:%i') as display_created_at
         FROM ticket_messages
         INNER JOIN users ON ticket_messages.user_id = users.id
         WHERE ticket_messages.ticket_id = {$id}
         ORDER BY ticket_messages.created_at DESC"
      );
   }
}
