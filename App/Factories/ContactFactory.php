<?php
namespace App\Factories;

use App\Models\Contact;

abstract class ContactFactory
{
   //
   public static function create($fields)
   {
      extract($fields);

      if (empty($name))
      {
         throw new \Exception("Por favor, informe seu nome.");
      }
      elseif (empty($email))
      {
         throw new \Exception("Por favor, informe seu email.");
      }
      elseif (empty($message))
      {
         throw new \Exception("Por favor, informe a mensagem.");
      }
      else
      {
         $contact = new Contact;
         $contact->name       = $name;
         $contact->email      = strtolower($email);
         $contact->message    = $message;
         $contact->created_at = date('Y-m-d H:i:s');

         return $contact;
      }
   }
}
