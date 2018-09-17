<?php
namespace App\Models;

use App\Core\Model;

class Topic extends Model
{
   protected $tableName = 'topics';
   protected $primaryKey = 'id';

   public $id;
   public $description;

   public static function lista()
   {
      return parent::db()->select('*')->from('topics')->orderBy('description')->fetchAll();
   }

   public static function find($id)
   {
      $result = parent::db()->select('*')->from('topics')->where('id', '=', $id)->fetchAll();

      if (! empty($result))
      {
         $topic = new self;
         $topic->fill($result[0]);
         return $topic;
      }
      return null;
   }
}
