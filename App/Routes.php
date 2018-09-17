<?php
namespace App;

$router = new Core\Router(new Core\Request);

$router->get('/seed', 'SeedController@index');

$router->get('/', 'HomeController@index');
$router->post('/fale-conosco', 'ContactController@save');
$router->get('/login/cliente', 'LoginController@cliente');
$router->get('/login/atendente', 'LoginController@atendente');
$router->get('/cliente/dashboard', 'Cliente\DashboardController@index');
$router->get('/cliente/lista-atendimentos', 'Cliente\TicketController@index');
$router->post('/cliente/novo-atendimento', 'Cliente\TicketController@create');
$router->get('/ticket/{:param}', 'TicketController@show');
$router->post('/responder-atendimento', 'TicketMessageController@save');
$router->post('/encerrar-atendimento', 'TicketController@closeTicket');
$router->get('/atendente/dashboard', 'Atendente\DashboardController@index');
$router->get('/atendente/lista-atendimentos', 'Atendente\TicketController@index');
$router->post('/ticket/editar', 'Atendente\TicketController@update');
