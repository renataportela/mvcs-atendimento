<?php
namespace App\Models;

use App\Core\Model;

class Role extends Model
{
   protected $tableName = 'roles';

   public $id;
   public $description;

   const CLIENTE = 1;
   const ATENDENTE = 2;
}
