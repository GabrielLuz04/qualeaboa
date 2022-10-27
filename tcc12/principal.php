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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Estilos/resset.css">
    <link rel="stylesheet" href="./Estilos/style_principal.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Qual é a boa?</title>
</head>
<body>
    <header>
        <h2 class="perf"> <a href="perfil.php" target="_self"> <?php echo $_SESSION['login']?> <img src="./assets/perfil.jpg" class="perfi"></a></h2>
    </header>

    <div class="cabecalho">
    <h1 class="titulo">PRINCIPAIS EVENTOS</h1>    
    <h2 class="filtro"><img src="./assets/filtro.png" class="filt" alt="filtro"> FILTROS</h2>
    </div>
    
    <?php while($dado = $con->fetch_array())?>

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
                   
            
            echo "<div class='flex-container'>
            <div class='card' style='width: 18rem;'>
            <img src='./assets/bota.jfif' class='card-img-top' alt='...'>
            <div class='card-body'>
            <h6 class='card-data'>$data_evento</h6>  
            <h4 class='card-title'>$nome_evento</h4>
            <h6 class='card-local'>$local_evento</h6>
            <button action='evento.php' class='btn btn-success' name='op' value='3'>Conferir</button>
            </div>
            </div>";
            $linha = mysqli_fetch_assoc($status);
       }
       
    ?>

    <!-- <div class="card" style="width: 18rem;">
        <img src="./assets/bota.jfif" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">Sáb, 06 Ago · 16:30</h6>  
        <h4 class="card-title">Botafogo x Ceará</h4>
        <h6 class="card-local">Estádio Nilton Santos</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/rock.jfif" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">02 SET  >  04 SET  ·  08 SET  >  11 SET</h6>  
        <h4 class="card-title">Rock In Rio</h4>
        <h6 class="card-local">Parque Olímpico - RJ</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/copa.jpg" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">21 NOV  > 18 DEZ</h6>  
        <h4 class="card-title">Copa do Mundo </h4>
        <h6 class="card-local">Catar</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/bbq.jfif" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">27 MAI  >  29 MAI</h6>  
        <h4 class="card-title">Blend BBQ Festival</h4>
        <h6 class="card-local">Caminho Niemeyer</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/brag.png" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">SÁB, 20 SET · 19:00</h6>  
        <h4 class="card-title">Brasil x Argentina</h4>
        <h6 class="card-local">Arena Fonte Nova</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/tivoli.jfif" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">30 JUL > 07 AGO</h6>  
        <h4 class="card-title">Tivoli Park</h4>
        <h6 class="card-local">Via Parque Shopping</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> 

    <div class="card" style="width: 18rem;">
        <img src="./assets/comic.png" class="card-img-top" alt="...">
        <div class="card-body">
        <h6 class="card-data">21 JUL  >  24 JUL</h6>  
        <h4 class="card-title">Comic Con</h4>
        <h6 class="card-local">San Diego</h6>
        <a href="#" class="btn btn-success">Conferir</a>
        </div>
    </div> -->
</div>

</body>
</html>

