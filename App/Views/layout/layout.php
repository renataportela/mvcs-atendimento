<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Atendimento</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="/assets/css/style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
     integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
     crossorigin="anonymous"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
      integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
      crossorigin="anonymous"></script>

   <script defer src="/assets/js/app.js"></script>

   <?php if (isset($initialState)):?>
   <script type="text/javascript">
      window.__INITIAL_STATE__ = <?= json_encode($initialState, JSON_UNESCAPED_UNICODE) ?>;
      console.log(window.__INITIAL_STATE__);
   </script>
   <?php endif; ?>
</head>
<body>
    <div id="app">
      <nav class="navbar navbar-inverse navbar-fixed-top">
         <div class="container">
           <div class="navbar-header">
             <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
               <span class="sr-only">Toggle navigation</span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
               <span class="icon-bar"></span>
             </button>
             <a class="navbar-brand" href="/">Atendimento</a>
           </div>
           <div id="navbar" class="navbar-collapse collapse">
             <ul class="nav navbar-nav navbar-right">
                <!-- Mock de acesso do usuário -->
               <?php if (isset($_SESSION['user'])): ?>
                 <?php if (isset($_SESSION['cliente']) and $_SESSION['user'] == $_SESSION['cliente']): ?>
                   <li><a href="/login/atendente">Entrar como Atendente</a></li>
                 <?php else: ?>
                   <li><a href="/login/cliente">Entrar como Cliente</a></li>
                 <?php endif; ?>
               <?php endif; ?>

               <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                 <ul class="dropdown-menu">
                   <li><a href="#">Action</a></li>
                   <li><a href="#">Another action</a></li>
                   <li><a href="#">Something else here</a></li>
                   <li role="separator" class="divider"></li>
                   <li><a href="#">Separated link</a></li>
                 </ul>
               </li>
             </ul>
           </div><!--/.navbar-collapse -->
         </div>
       </nav>

       <?php require dirname(__DIR__) .'\\'.$viewFile.'.php'; ?>

       <div class="container" style="margin-top: 40px;">

          <hr>

          <footer>
           <p>&copy; 2018 Company, Inc.</p>
          </footer>
       </div>

       <div id="alerts"></div>
   </div>
</body>
</html>
