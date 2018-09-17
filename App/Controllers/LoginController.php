<?php
namespace App\Controllers;

use \App\Models\User;
use \App\Core\Controller;

class LoginController extends Controller
{
   public function cliente($request)
   {
     if (! isset($_SESSION['cliente']))
     {
       $user = User::mockCliente();

       $_SESSION['cliente'] = $user->id;
     }

     $_SESSION['user'] = $_SESSION['cliente'];

     header('Location: /cliente/dashboard');
   }

   public function atendente($request)
   {
     if (! isset($_SESSION['atendente']))
     {
       $user = User::mockAtendente();

       $_SESSION['atendente'] = $user->id;
     }

     $_SESSION['user'] = $_SESSION['atendente'];

     header('Location: /atendente/dashboard');
   }
}
