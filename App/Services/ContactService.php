<?php
namespace App\Services;

use \App\Factories\ContactFactory;

class ContactService
{
   public static function saveNewContact($fields)
   {
      try{
         $contact = ContactFactory::create($fields);
         $contact->save();

         return [
            'status' => 'success',
            'message' => 'Mensagem registrada com sucesso.'
         ];
      }
      catch (\Exception $error){
         header("HTTP/1.0 400 Bad Request");
         return [
            'status' => 'danger',
            'message' => $error->getMessage()
         ];
      }
   }
}
