<div class="jumbotron">
 <div class="container">
   <h1>Olá, visitante!</h1>
   <p>Você pode entrar no sistema como um Cliente ou um Atendente.</p>
   <p>
      <a href="/login/cliente" class="btn btn-primary btn-lg mb-2" role="button">Entrar como Cliente</a>
      <a href="/login/atendente" class="btn btn-info btn-lg mb-2" role="button">Entrar como Atendente</a>
   </p>
 </div>
</div>

<div class="container">

   <div class="row">
      <div class="col-md-6 col-md-offset-3">
         <h3 class="text-center">Fale Conosco</h3>

         <p class="text-center">O cliente pode solicitar um atendimento sem estar registrado</p>

         <br>

         <form action="/fale-conosco" id="formFaleConosco">
            <div class="form-group">
               <label for="name">Nome</label>
               <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
               <label for="email">Email</label>
               <input type="email" class="form-control" name="email" required>
            </div>

            <div class="form-group">
               <label for="message">Mensagem</label>
               <textarea class="form-control" name="message" rows="6" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
         </form>
      </div>
   </div>
</div>

<script type="text/javascript" defer>
   $(function(){
      onSubmitForm('#formFaleConosco');
   });
</script>
