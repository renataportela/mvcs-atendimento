<?php
namespace App\Models;

use App\Core\Model;
use App\Models\User;
use App\Models\Topic;
use App\Models\StatusTicket;

class Ticket extends Model
{
   protected $tableName = 'tickets';
   protected $primaryKey = 'id';

   public $id;
   public $message;
   public $origin;
   public $created_at;
   public $display_created_at;
   public $topic;
   public $status;
   public $user;

   public function __construct(User $user, Topic $topic, StatusTicket $status)
   {
      // parent::__construct();
      $this->topic  = $topic;
      $this->status = $status;
      $this->user   = $user;
   }

   public function save()
   {
      $this->db()->insert($this->tableName, [
         'user_id'    => $this->user->id,
         'message'    => $this->message,
         'created_at' => $this->created_at,
         'topic_id'   => $this->topic->id,
         'status_id'   => $this->status->id
      ]);
   }

   private static function sqlDadosTicket()
   {
      return
         "SELECT tickets.*, DATE_FORMAT(tickets.created_at, '%d/%m/%Y %H:%i') as display_created_at,
            topics.description AS topic, subtopics.description AS subtopic,
            status_tickets.description as status, users.name
          FROM tickets
          INNER JOIN users ON tickets.user_id = users.id
          INNER JOIN topics ON tickets.topic_id = topics.id
          INNER JOIN status_tickets ON tickets.status_id = status_tickets.id
          LEFT JOIN subtopics ON tickets.subtopic_id = subtopics.id";
   }

   public static function find($id)
   {
      $dados = parent::db()->sqlSelect(self::sqlDadosTicket() ." WHERE tickets.id = {$id}");

      if (! empty($dados))
      {
         $ticket = new self(new User, new Topic, new StatusTicket);

         extract($dados[0]);
         $ticket->id = $id;
         $ticket->email = $email;
         $ticket->message = $message;
         $ticket->origin = $origin;
         $ticket->display_created_at = $display_created_at;
         $ticket->topic->id = $topic_id;
         $ticket->topic->description = $topic;
         $ticket->status->id = $status_id;
         $ticket->status->description = $status;
         $ticket->user->name = $name;

         return $ticket;
      }

      return null;
   }

   public static function listaDoCliente($id)
   {
      return parent::db()->sqlSelect(
         self::sqlDadosTicket() ." WHERE tickets.user_id = {$id} ORDER BY tickets.created_at DESC"
      );
   }

   public static function listaPorStatus()
   {
      return parent::db()->sqlSelect(
         self::sqlDadosTicket() .' ORDER BY status_id, tickets.created_at DESC'
      );
   }

   public function update()
   {
      $this->db()->update('tickets')
         ->set([ 'status_id' => $this->status->id, 'topic_id' => $this->topic->id ])
         ->where('id', '=', $this->id)
         ->run();
   }

   public function atualizaStatus($status_id)
   {
      $this->db()->update('tickets')
         ->set([ 'status_id' => $status_id ])
         ->where('id', '=', $this->id)
         ->run();
   }
}
