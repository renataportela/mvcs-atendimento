<?php
namespace App\Models;

use App\Core\Model;
use App\Models\Role;

class User extends Model
{
   protected $tableName = 'users';

   public $id;
   public $role_id;
   public $name;
   public $email;
   public $status;
   public $created_at;

   private static function mockUser($role_id): User
   {
     $user = new User();

     $result = $user->db()->select('*')->from('users')->where('role_id', '=', $role_id)->limit(1)->fetchAll();
     $user->fill($result[0]);
     return $user;
   }

   public static function mockCliente()
   {
       return self::mockUser(Role::CLIENTE);
   }

   public static function mockAtendente()
   {
     return self::mockUser(Role::ATENDENTE);
   }

   public static function find($id)
   {
      $result = parent::db()->select('*')->from('users')->where('id', '=', $id)->fetchAll();

      if (! empty($result))
      {
         $user = new self;
         $user->fill($result[0]);
         return $user;
      }
      return null;
   }
}
