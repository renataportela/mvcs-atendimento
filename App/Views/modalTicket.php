<div id="modalTicket" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Visualizar Atendimento</h4>
      </div>
      <div class="modal-body">

         <p id="carregandoModalTicket">Carregando...</p>

         <div id="conteudo">

            <h3 class="page-title" style="margin-top:10px;">Assunto</h3>

            <p>
               <small>
                  <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> <span id="data"></span>
                  <span style="padding-left: 20px">
                     <strong id="status"></strong>
                  </span>
               </small>
            </p>

            <p><span class="badge" id="topic"></span></p>

            <blockquote id="message"></blockquote>

            <div id="area_historico" class="hidden">
               <h3 class="page-title">Histórico do Atendimento</h3>

               <div id="historicos"></div>

            </div>
         </div><!-- fim conteudo -->

         <h3 class="page-title">Enviar Resposta</h3>

         <form action="/responder-atendimento" id="formTicketResponse">

            <input type="hidden" name="ticket_id" id="ticket_id" value="">

            <div class="form-group">
              <label for="message">Mensagem</label>
              <textarea class="form-control" name="message" id="response_message" rows="3" required></textarea>
            </div>

            <div class="text-center">
              <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
              <button type="button" id="btnEncerrarAtendimento" class="btn btn-secondary">Encerrar Atendimento</button>
            </div>
         </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
