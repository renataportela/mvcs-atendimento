# mvcs-atendimento
Sistema de atendimento básico

## Como usar

- git clone https://github.com/renataportela/mvcs-atendimento.git
- cd mvcs-atendimento
- configure o banco de dados no arquivo App/Core/BD.php (1)
- composer install
- cd public
- php -S 127.0.0.1:8000
- acesse 127.0.0.1:8000/seed (2)
- pronto

## Observações

(1) TODO: separar os dados de configuração em arquivo próprio
(2) Neste projeto, a autenticação do usuário não foi implementada, apenas simulada

## Factory

```
abstract class TicketMessageFactory
{
   public static function create($fields)
   {
      ...
      $user = User::find($_SESSION['user']);
      $ticket = Ticket::find($ticket_id);

      $ticketMessage = new TicketMessage($ticket, $user);
      $ticketMessage->message    = $message;
      $ticketMessage->created_at = date('Y-m-d H:i:s');

      return $ticketMessage;
      ...
   }
}
```

## Dependency Injection

```
class TicketMessage extends Model{
   ...

   public $ticket;
   public $user;

   public function __construct(Ticket $ticket, User $user)
   {
      $this->ticket = $ticket;
      $this->user = $user;
   }

   ...
}
```
