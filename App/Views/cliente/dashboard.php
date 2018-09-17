<?php require dirname(__DIR__) . '/modalTicket.php'; ?>

<div id="modalNewTicket" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Solicitar Novo Atendimento</h4>
      </div>
      <div class="modal-body">

         <form action="/cliente/novo-atendimento" id="formNewTicket">
            <div class="form-group">
               <label for="topic_id">Assunto</label>
               <select class="form-control" name="topic_id" required>
                  <option value="">Selecione...</option>
                  <?php foreach($topicos as $topico): ?>
                  <option value="<?= $topico['id']?>"><?= utf8_decode($topico['description']) ?></option>
                  <?php endforeach; ?>
               </select>
            </div>

            <div class="form-group">
               <label for="message">Mensagem</label>
               <textarea class="form-control" name="message" rows="6" required></textarea>
            </div>

            <div class="text-center">
               <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
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
         <h1 class="page-title">Olá, Cliente!</h1>

         <div class="panel panel-default">
          <div class="panel-body">

            <div class="clearfix">
              <h3 class="pull-left" style="margin-top:9px;">Atendimentos Solicitados</h3>

              <button type="button"
                  class="btn btn-primary pull-right"
                  data-toggle="modal"
                  data-target="#modalNewTicket"
                  style="margin-top:9px;">Novo Atendimento</button>
            </div>

            <div id="nenhumAtendimento" class="alert alert-warning mt-4" role="alert">
               Não há atendimentos Solicitados.
            </div>

            <div class="table-responsive">
               <table id="tabelaTickets" class="table table-hover hidden">
                 <thead>
                   <tr>
                     <th>#ID</th>
                     <th>Data</th>
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

<script type="text/javascript" defer>

   function atualizarDadosLista(dadosLista)
   {
      $('#nenhumAtendimento').hide();
      $('#tabelaTickets').removeClass('hidden');

      var bodyTable = '';

      for (var row of dadosLista){
         bodyTable += '<tr><td>'+row.id+'</td><td>'+row.display_created_at+'</td><td><strong>'+row.topic+
         '</strong></td><td>'+row.message+'</td><td>'+row.status+'</td><td class="text-right">'+
         '<button class="btn btn-sm btn-info abreModalTicket" data-id="'+row.id+'">Visualizar</a></td></tr>';
      }

      $('#tabelaTickets').find('tbody').html(bodyTable);

      $('.abreModalTicket').click(function(){
         $('#ticket_id').val($(this).data('id'));
         $('#modalTicket').modal('show');
      });
   }

   function atualizarLista()
   {
      get('/cliente/lista-atendimentos').done(function(res){
         atualizarDadosLista(res.lista)
      });
   }

   $(function(){

      onSubmitForm('#formNewTicket', function(){
         $('#modalNewTicket').modal('hide');

         atualizarLista();
      });

      const initialData = window.__INITIAL_STATE__;

      if (initialData.total > 0){
         atualizarDadosLista(initialData.lista);
      }

      handleShowModalTicket(atualizarLista);

      onSubmitForm('#formTicketResponse', function(){
         $('#modalTicket').modal('hide');
         atualizarLista();
      });
   });
</script>
