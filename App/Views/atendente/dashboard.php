<?php require dirname(__DIR__) . '/modalTicket.php'; ?>

<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Chamado</h4>
      </div>
      <div class="modal-body">
         <form id="formTicketEditar" action="/ticket/editar" method="post">

            <p id="carregandoModalEditar">Carregando...</p>

            <input type="hidden" name="ticket_id" class="ticket_id" value="">

            <p class="text-uppercase text-info"><strong id="user_name"></strong></p>

            <div class="form-group">
               <label for="topic_id">Assunto</label>
               <select class="form-control" name="topic_id" id="topic_id" required>
                  <option value="">Selecione...</option>
                  <?php foreach($topicos as $topico): ?>
                  <option value="<?= $topico['id']?>"><?= utf8_decode($topico['description']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="form-group">
               <label for="status_id">Status</label>
               <select class="form-control" name="status_id" id="status_id" required>
                  <option value="">Selecione...</option>
                  <?php foreach($listaStatus as $status): ?>
                  <option value="<?= $status['id']?>"><?= $status['description'] ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="text-center">
               <button type="submit" class="btn btn-primary">Salvar</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
         </form>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="container">
   <div class="row">
     <div class="col-sm-12">

       <h1 class="page-title">Olá, Atendente!</h1>

         <ul class="nav nav-tabs nav-pills" role="tablist" style="margin-bottom:15px;">
           <li role="presentation" class="active">
             <a href="#abertos" aria-controls="abertos" role="tab" data-toggle="tab">Aguardando Atendimento <span id="total_<?= App\Models\StatusTicket::AGUARDANDO_ATENDIMENTO ?>" class="badge">0</span></a>
           </li>
           <li role="presentation">
             <a href="#respondidos" aria-controls="respondidos" role="tab" data-toggle="tab">Respondidos <span class="badge" id="total_<?= App\Models\StatusTicket::RESPONDIDOS ?>">0</span></a>
           </li>
           <li role="presentation">
             <a href="#encerrados" aria-controls="encerrados" role="tab" data-toggle="tab">Encerrados <span class="badge" id="total_<?= App\Models\StatusTicket::ENCERRADOS ?>">0</span></a>
           </li>
         </ul>

       <div class="panel panel-default">
        <div class="panel-body">

          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="abertos">

               <div id="nenhumAtendimento_<?= App\Models\StatusTicket::AGUARDANDO_ATENDIMENTO ?>" class="alert alert-warning mt-4" role="alert">
                  Não há chamados aguardando atendimento.
               </div>

               <div class="table-responsive">
                 <table id="tabelaTickets_<?= App\Models\StatusTicket::AGUARDANDO_ATENDIMENTO ?>" class="table table-hover hidden">
                   <thead>
                     <tr>
                       <th>#ID</th>
                       <th>Data</th>
                       <th>Cliente</th>
                       <th>Assunto</th>
                       <th>Mensagem</th>
                       <th>Status</th>
                       <th></th>
                     </tr>
                   </thead>
                   <tbody>
                   </tbody>
                 </table>
              </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="respondidos">
               <div id="nenhumAtendimento_<?= App\Models\StatusTicket::RESPONDIDOS ?>" class="alert alert-warning mt-4" role="alert">
                  Não há chamados respondidos.
               </div>

               <div class="table-responsive">
                    <table id="tabelaTickets_<?= App\Models\StatusTicket::RESPONDIDOS ?>" class="table table-hover hidden">
                      <thead>
                        <tr>
                          <th>#ID</th>
                          <th>Data</th>
                          <th>Cliente</th>
                          <th>Assunto</th>
                          <th>Mensagem</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                 </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="encerrados">
               <div id="nenhumAtendimento_<?= App\Models\StatusTicket::ENCERRADOS ?>" class="alert alert-warning mt-4" role="alert">
                  Não há chamados respondidos.
               </div>

               <div class="table-responsive">
                    <table id="tabelaTickets_<?= App\Models\StatusTicket::ENCERRADOS ?>" class="table table-hover hidden">
                      <thead>
                        <tr>
                          <th>#ID</th>
                          <th>Data</th>
                          <th>Cliente</th>
                          <th>Assunto</th>
                          <th>Mensagem</th>
                          <th>Status</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                 </div>
            </div>
          </div>
        </div>
      </div>


     </div>
   </div>
</div>

<script type="text/javascript" defer>
   // $(function(){
   //
   //    onSubmitForm('#formResponder');
   //

   // });

   function atualizarDadosLista(statusId, dadosLista)
   {
      $('#nenhumAtendimento_'+statusId).hide();
      $('#tabelaTickets_'+statusId).removeClass('hidden');
      $('#total_'+statusId).html(dadosLista.total);

      var bodyTable = '';

      for (var row of dadosLista.lista){
         bodyTable += '<tr><td>'+row.id+'</td><td>'+row.display_created_at+'</td><td>'+row.name+
         '</td><td><strong>'+row.topic+
         '</strong></td><td>'+row.message+'</td><td>'+row.status+'</td><td class="text-right"><button class="btn btn-sm btn-info abreModalEditar" data-id="'+row.id+'">Editar</a><button class="btn btn-sm btn-primary abreModalTicket ml-1" data-id="'+row.id+'">Visualizar</a></td></tr>';
      }

      $('#tabelaTickets_'+statusId).find('tbody').html(bodyTable);

      $('#tabelaTickets_'+statusId+' tbody .abreModalTicket').click(function(){
         $('#ticket_id').val($(this).data('id'));
         $('#modalTicket').modal('show');
      });

      $('#tabelaTickets_'+statusId+' tbody .abreModalEditar').click(function(){
         $('.ticket_id').val($(this).data('id'));
         $('#modalEditar').modal('show');
      });
   }

   function atualizarDadosListas(listas)
   {
      const statusListas = Object.keys(listas);
      if (statusListas.length > 0){
         statusListas.forEach(function(status_id){
            const dadosLista = listas[status_id];

            if (typeof dadosLista.lista != 'undefined' && dadosLista.lista.length > 0){
               atualizarDadosLista(status_id, dadosLista);
            }
         });
      }
   }

   function atualizarListas()
   {
      get('/atendente/lista-atendimentos').done(function(res){
         atualizarDadosListas(res.listas)
      });
   }


   $(function(){
      const initialState = window.__INITIAL_STATE__;

      atualizarDadosListas(initialState.listas);

      handleShowModalTicket(atualizarListas);

      onSubmitForm('#formTicketResponse', function(){
         $('#modalTicket').modal('hide');
         atualizarListas();
      });

      onSubmitForm('#formTicketEditar', function(){
         $('#modalEditar').modal('hide');
         atualizarListas();
      });

      $('#modalEditar').on('show.bs.modal', function (event) {

        $('#carregandoModalEditar').show();

        var id = $('.ticket_id').val();
        var modal = $(this);

        get('/ticket/'+id)
           .done(function(res){
               modal.find('.modal-body #user_name').html(res.ticket.user.name);
               modal.find('.modal-body #topic_id').val(res.ticket.topic.id);
               modal.find('.modal-body #status_id').val(res.ticket.status.id);
           })
           .always(function(){
               $('#carregandoModalEditar').hide();
           });
      });
   });
</script>
