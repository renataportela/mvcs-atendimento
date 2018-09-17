<?php
namespace App\Factories;

use App\Models\User;
use App\Models\Topic;
use App\Models\Ticket;
use App\Models\StatusTicket;

abstract class TicketFactory
{
    public static function create($fields)
    {
        extract($fields);

        if (! isset($_SESSION['user']) or empty($_SESSION['user']))
        {
          throw new \Exception("Para registrar um ticket, é ncessário estar logado.");
        }
        elseif (empty($topic_id))
        {
          throw new \Exception("Por favor, informe o assunto.");
        }
        elseif (empty($message))
        {
          throw new \Exception("Por favor, informe a mensagem.");
        }
        else
        {
          $user = User::find($_SESSION['user']);
          $topic = Topic::find($topic_id);
          $status = StatusTicket::find(StatusTicket::AGUARDANDO_ATENDIMENTO);

          $ticket = new Ticket($user, $topic, $status);

          $ticket->message    = $message;
          $ticket->created_at = date('Y-m-d H:i:s');

          return $ticket;
        }
    }
}
