function get(url)
{
   return $.get(url)
      .fail(function(error){
          showErrorMessage(error);
      });
}

function handleShowModalTicket(callbackAtualizar)
{
   $('#modalTicket').on('show.bs.modal', function (event) {

     var modal = $(this);
     var id = $('#ticket_id').val();

     $('#response_message').val('');

     get('/ticket/'+id)
        .done(function(res){
            modal.find('.modal-body #topic').html(res.ticket.topic.description);
            modal.find('.modal-body #status').html(res.ticket.status.description);
            modal.find('.modal-body #data').html(res.ticket.display_created_at);
            modal.find('.modal-body #message').html(res.ticket.message);

            if (res.messages.length > 0){
               $('#historicos').html('');
               $('#area_historico').removeClass('hidden');

               var historicos = '';

               for (var historico of res.messages){
                  historicos += '<div class="panel panel-default"><div class="panel-heading text-small"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span><span class="pr-2">'+historico.display_created_at+'</span><span class="glyphicon glyphicon-user" aria-hidden="true"></span> '+historico.user_name+' </div><div class="panel-body">'+historico.message+'</div></div>';
               }

               $('#historicos').html(historicos);
            }
            else{
               $('#area_historico').addClass('hidden');
               $('#historicos').html('');
            }
        })
        .always(function(){
            $('#carregandoModalTicket').hide();
        });
   });

   $('#btnEncerrarAtendimento').click(function(){
      if (confirm('Tem certeza que deseja encerrar este atendimento?')){

         const button = $(this);

         button.prop('disabled', true);

         $.post('/encerrar-atendimento', { id: $('#ticket_id').val() },
             function(res){
                 if (res.status == 'success'){
                    showSuccessMessage(res.message);
                    $('#modalTicket').modal('hide');
                    callbackAtualizar();
                 }
             })
             .fail(function(error){
                 showErrorMessage(error.responseJSON.message);
             })
             .always(function(){
                button.prop('disabled', false);
             });
      }
   });
}

/*
 * Submete os dados do formulário via post
 * @param formId     Id do formulário a ser submetido
 * @return xhr
 * */
function onSubmitForm(formId, onSuccess) {

   $(formId).submit(function(e)
   {
      e.preventDefault();

      const form = $(formId);
      const button = form.find('button[type="submit"]');

      button.prop('disabled', true);

      return $.post(this.action, form.serialize(),
          function(res){
              if (res.status == 'success'){
                 showSuccessMessage(res.message);
                 form[0].reset();

                 if (onSuccess != undefined){
                    onSuccess();
                 }
              }
          })
          .fail(function(error){
              showErrorMessage(error.responseJSON.message);
          })
          .always(function(){
             button.prop('disabled', false);
          });
   });
}

function showErrorMessage(message){
   showMessage('danger', message);
}

function showSuccessMessage(message){
   showMessage('success', message);
}

/*
 * Exibe uma mensagem do tipo toast
 * @param message   Conteúdo da mensagem
 * @param type      Tipo da mensagem: danger, success, info, warning
 *
 * */
function showMessage(type, message)
{
    if (message != undefined && message != '')
    {
      $('#alerts')
         .append('<div class="alert alert-'+type+'" role="alert">'+message+'</div>')
         .find('.alert:last')
         .fadeIn('fast')
         .delay(4000)
         .fadeOut(900);
    }
}
