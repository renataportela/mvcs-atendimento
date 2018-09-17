<?php
namespace App\Controllers;

use \App\Core\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\Topic;
use App\Models\StatusTicket;
use App\Core\DB;

class SeedController extends Controller
{
   public function index()
   {
      $bd = DB::getInstance();

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `contacts` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `name` varchar(200) NOT NULL,
           `email` varchar(200) NOT NULL,
           `message` text NOT NULL,
           `status` enum('Aguardando','Respondido','Chamado') NOT NULL DEFAULT 'Aguardando',
           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`)
        ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `faq` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `topic_id` int(11) NOT NULL,
           `title` varchar(200) NOT NULL,
           `description` text NOT NULL,
           `votes` int(11) NOT NULL DEFAULT '0',
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `roles` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `description` varchar(50) NOT NULL,
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `status_tickets` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `description` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `tickets` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `user_id` int(11) NOT NULL,
           `topic_id` int(11) DEFAULT NULL,
           `status_id` int(11) DEFAULT NULL,
           `email` varchar(200) CHARACTER SET utf8 NOT NULL,
           `message` text CHARACTER SET utf8 NOT NULL,
           `rating` int(2) DEFAULT NULL,
           `origin` enum('Fale Conosco','Chamados') CHARACTER SET utf8 NOT NULL DEFAULT 'Chamados',
           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`),
           KEY `fk_tickets_user` (`user_id`),
           KEY `fk_tickets_topic` (`topic_id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `ticket_messages` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `ticket_id` int(11) NOT NULL,
           `user_id` int(11) DEFAULT NULL,
           `message` text NOT NULL,
           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `topics` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `description` varchar(200) NOT NULL,
           PRIMARY KEY (`id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
      );

      $bd->rawSql(
         "CREATE TABLE IF NOT EXISTS `users` (
           `id` int(11) NOT NULL AUTO_INCREMENT,
           `role_id` int(11) NOT NULL,
           `name` varchar(200) NOT NULL,
           `email` varchar(200) NOT NULL,
           `password` text NOT NULL,
           `status` enum('Ativo','Inativo') NOT NULL DEFAULT 'Ativo',
           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
           PRIMARY KEY (`id`),
           KEY `fk_users_role` (`role_id`)
         ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
      );

      $role = new Role;
      $role->insert(['description' => 'Cliente']);
      $role->insert(['description' => 'Atendente']);

      $userData = [
       'role_id' => Role::CLIENTE,
       'name' => 'Cliente',
       'email' => 'email@email.com',
       'password' => password_hash('123456', PASSWORD_BCRYPT),
       'created_at' => date('Y-m-d H:i:s')
      ];

      $user = new User;
      $user->insert($userData);

      $userData['role_id'] = Role::ATENDENTE;
      $userData['name'] = 'Atendente';
      $user->insert($userData);

      $topic = new Topic;
      $topic->insert(['description' => 'Vendas' ]);
      $topic->insert(['description' => 'Entrega' ]);
      $topic->insert(['description' => 'Outros' ]);

      $status = new StatusTicket;
      $status->insert(['description' => 'Aguardando Atendimento' ]);
      $status->insert(['description' => 'Respondido' ]);
      $status->insert(['description' => 'Encerrado' ]);

      $this->response->view('seed');
   }
}
