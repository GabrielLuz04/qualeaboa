<?php
    include("verifica_login.php");
    include("banco.php"); // caminho do seu arquivo de conexão ao banco de dados 
    $host = "127.0.0.1";  
    $db   = "qualeaboa";     
    $user = "root";       
    $pass = "";           

    $conn = mysqli_connect("$host","$user","$pass","$db") or die ("problemas na conexão");
    $consulta = "SELECT * FROM usuario"; 
    $con = $conn->query($consulta) or die($conn->error);

   

?>

<!doctype html>
<html lang="en">

<!-- https://startbootstrap.com/snippets/navbar-logo
https://codepen.io/girraj-ch/details/yLBdjNX -->


<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="./styles/style.css">
  <title>Qual é a boa?</title>
  <link REL="SHORTCUT ICON" HREF="assets/favicon.ico">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">
    <img src="assets/logofc.png" width="100" height="100" class="d-inline-block align-top" alt="">
    <!-- Bootstrap -->
  </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div id="menu">
    <ul>
        <li><a href="#Nit">Niterói</a></li>
        <li><a href="#ita">Itaboraí</a></li>
        <li><a href="#sg">São Gonçalo</a></li>
        <li><a href="#mar">Maricá</a></li>
        <li><a href="#rj">Rio de Janeiro</a></li>
    </ul>
</div>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="mr-auto"></div>
      <ul class="navbar-nav my-2 my-lg-0">
<li class="nav-item active">
        <a class="nav-link" href="criarevento.php">Criar um evento <span class="sr-only">(current)</span></a>
      </li>

      

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="perfil.php" id="navbarDropdown" role="button" data-display="static" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['login']?>
        </a>
          <div class="dropdown-menu dropdown-menu-lg-right" aria-labelledby="navbarDropdown">
            <h6 class="dropdown-header">
                <?php echo $_SESSION['login']?>
            </h6>
            <a class="dropdown-item" href="#">Meu perfil</a>
            <a class="dropdown-item" href="#">Ajuda</a>
            <a class="dropdown-item" href="#">Sair</a>
          </div>

        </li>

      </ul>

      </div>
  </nav>

  <div class="xereca">
    <h2 class="pri">Principais Eventos</h2>
</div>
    

<?php
       
       $sql = "select * from evento";
       
       $conn = conectar();
       
       $status = mysqli_query($conn,$sql);
       $total = mysqli_num_rows($status);
       
       echo"<center><table border=1 width=80%>";
       
       
       $linha = mysqli_fetch_array($status);
       
       for($i=0; $i<$total; $i++) {
           
           $nome_evento = $linha['nome_evento'];		
           $local_evento = $linha['local_evento'];		
           $cidade = $linha['cidade'];		
           $data_evento =  $linha['data_evento'];		
           $hora = $linha['hora'];		
           $preco =   $linha['preco'];	
           $classificacao_indicativa = $linha['classificacao_indicativa'];		 
           $assunto = $linha['assunto'];
           $descricao = $linha['descricao'];
           $autor = $linha['autor'];
           
           
           echo "
           
           <div class='flex-container'>
           <div class='card' style='width: 18rem;'>
           <form action='evento.php' method='get'>
        <img src='./assets/bfrcrp.jpg' class='card-img-top' alt='...'>
        <div class='card-body'>
        <h6 class='card-data'> $data_evento </h6>  
        <h4 class='card-title'>$nome_evento</h4>
        <h6 class='card-local'>$local_evento</h6>
        <input type='hidden' name='entrada' value='$nome_evento'>
                <input type='submit' class='btn btn-success' name='op' value='Conferir'>
        </input>
        </form>
        </div>
        </div>
           
           ";
            $linha = mysqli_fetch_assoc($status);
       }
       
    ?>
    
</body>
</html>