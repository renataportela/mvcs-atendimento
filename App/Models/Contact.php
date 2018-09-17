<?php
namespace App\Models;

use App\Core\Model;

class Contact extends Model
{
   public $id;
   public $name;
   public $email;
   public $message;
   public $status;
   public $created_at;

   protected $tableName = 'contacts';
   protected $primaryKey = 'id';
}
