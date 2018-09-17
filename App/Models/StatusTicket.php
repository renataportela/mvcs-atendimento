<?php
namespace App\Models;

use App\Core\Model;

class StatusTicket extends Model
{
   protected $tableName = 'status_tickets';
   protected $primaryKey = 'id';

   public $id;
   public $description;

   const AGUARDANDO_ATENDIMENTO = 1;
   const RESPONDIDOS = 2;
   const ENCERRADOS = 3;

   public static function lista()
   {
      return parent::db()->select('*')->from('status_tickets')->orderBy('description')->fetchAll();
   }

   public static function find($id)
   {
      $result = parent::db()->select('*')->from('status_tickets')->where('id', '=', $id)->fetchAll();

      if (! empty($result))
      {
         $status = new self;
         $status->fill($result[0]);
         return $status;
      }
      return null;
   }
}
