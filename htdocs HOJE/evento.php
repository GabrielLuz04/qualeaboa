<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Qual é a boa?</title>
</head>

<?php

include("verifica_login.php");
include("banco.php"); // caminho do seu arquivo de conexão ao banco de dados 
$host = "127.0.0.1";  
$db   = "qualeaboa";     
$user = "root";       
$pass = "";           

require_once("banco.php");
$conn = mysqli_connect("$host","$user","$pass","$db") or die ("problemas na conexão");
$consulta = "SELECT * FROM usuario"; 
$con = $conn->query($consulta) or die($conn->error);
$operacao = $_GET["op"];
$entrada = $_GET["entrada"];


switch($operacao){
	

		case 1:  // incluir
			if($entrada == 1) 
				formIncluir();
			if($entrada == "CRIAR") 
				execIncluir();    
			break;
		case 2:  // listar
			execListar();
			break;
		case "Conferir":
			execPesquisar();   
			break;
		case 'Editar':  // alterar
			// $entrada = $_GET['entrada'];
			// if($entrada == 1)
			// 	formPesquisarAlterar();
			// if($entrada == 2)
				formAlterar();   
			// if($entrada == 3)
			// 	execAlterar();   
			break;
		case 'ExecAlterar':
			execAlterar();  
			break;
		case 'Excluir':  // excluir
			$entrada = $_GET['entrada'];            
			// if($entrada == 1)
			// 	formExcluir();
			if($entrada == 0)
			execConfirmacaoExcluir();
			if($entrada == 3)
				execExcluir();   
		break;
	}	

// function formIncluir() {
	
// 	echo "
//     <html>
//     <head>
// 	    <meta charset='utf-8'>
//     </head>
//     <body>
//     <center><h1>CRIAÇÃO DE EVENTOS</h1></center>
//     <HR>
// 	    <form action='evento.php' method='GET'>
// 		    PREENCHA OS DADOS: <BR>
// 			<br>NOME: <input type='text' name='nome_evento'> <br>
// 			<br>ENDEREÇO: <input type='text' name='local_evento'> <br>			
// 			<br>CIDADE: <input type='text' name='cidade'> <br>
// 			<br>DATA:<input type='date' name='data_evento'> <br>
// 			<br>HORA:<input type='time' name='hora'> <br>
// 			<br>PREÇO:<input type='text' name='preco'> <br>
// 			<br>CLASSIFICAÇÃO INDICATIVA:<input type='int' name='classificacao_indicativa'> <br>			
// 			<br>ASSUNTO:<input type='text' name='assunto'> <br>
// 			<br>DESCRIÇÃO:<input type='textarea' name='descricao'> <br><br>
//             <input type='hidden' name='op' value='1'>
// 		    <input type='hidden' name='entrada' value='2'>
// 		    <input type='submit' name='enviar' value='CRIAR'>
// 		    <input type='reset' name='limpar' value='LIMPAR'>
//         </form>
//     </body>
//     </html>	
//     ";

// }

function execIncluir() {
	
	$nome_evento = $_GET['nome_evento'];
	$local_evento = $_GET['local_evento'];
	$cidade = $_GET['cidade'];
	$data_evento = $_GET['data_evento'];
	$hora = $_GET['hora'];
	$preco = $_GET['preco'];
	$classificacao_indicativa = $_GET['classificacao_indicativa'];
	$assunto = $_GET['assunto'];
	$descricao = $_GET['descricao'];
	$autor = $_GET['autor'];
	
	$sql = "INSERT INTO evento (nome_evento, local_evento, cidade, data_evento, hora, preco, classificacao_indicativa, assunto, descricao, autor) values('$nome_evento', '$local_evento', '$cidade', '$data_evento', '$hora', '$preco', '$classificacao_indicativa', '$assunto', '$descricao', '$autor')";

	
	
	
	
	
	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	
	if($status)
	    echo "<br>Evento criado com sucesso!";
	else
	    echo "<br>EERRO AO CRIAR O EVENTO. TENTE NOVAMENTE";
	
	echo "<br><hr><a href='./perfil.php'>VOLTAR</a>";
		
	
}
function execListar(){
	
	$sql = "select * from evento";
	
	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	$total = mysqli_num_rows($status);
	
	echo"<center><table border=1 width=80%>";
	echo"<TR><TH>NOME DO EVENTO</TH><TH>ENDEREÇO</TH><TH>CIDADE</TH><TH>DATA</TH><TH>HORA</TH><TH>PREÇO</TH><TH>CLASSIFICAÇÃO INDICATIVA</TH><TH>ASSUNTO</TH><TH>DESCRIÇÃO</TH></TR>";
	
	$linha = mysqli_fetch_array($status);
	
	for($i=0; $i<$total; $i++) {
        $nome_evento =    $linha['nome_evento'];		
		$local_evento = $linha['local_evento'];		
		$cidade = $linha['cidade'];		
		$data_evento =  $linha['data_evento'];		
		$hora = $linha['hora'];		
		$preco =   $linha['preco'];	
        $classificacao_indicativa = $linha['classificacao_indicativa'];		 
		$assunto = $linha['assunto'];
		$descricao = $linha['descricao'];
		$autor = $linha['autor'];
		 
		 echo"<tr><td>$nome_evento</td><td>$local_evento</td><td>$cidade</td><td>$data_evento</td><td>$hora</td><td>$preco</td><td>$classificacao_indicativa</td><td>$assunto</td><td>$descricao</td><td>$autor</td></tr>";
		 $linha = mysqli_fetch_assoc($status);
	}
	echo "</table></center>";
	echo "<br><hr><a href='./paginas/perfil.php'>VOLTAR</a>";
	
}
function formPesquisar() {
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>PESQUISA DE EVENTOS</h1></center>
    <HR>
	    <form action='evento.php' method='GET'>
		    <br>DIGITE O NOME DO EVENTO:<input type='text' name='nome_evento' autocomplete='on'> <br>
            <input type='hidden' name='op' value='3'>
		    <input type='hidden' name='entrada' value='2'>
		    <input type='submit' name='enviar' value='ENVIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>
        </form>
    </body>
    </html>	
	";
}
function execPesquisar(){
    $entrada = $_GET["entrada"];
	$nome_evento = $entrada;
	
	
	$conn = conectar();

	$sql = "SELECT * FROM evento WHERE '$nome_evento'=nome_evento";
	
	$dados = mysqli_query($conn,$sql) or die (mysqli_error($conn));
	$total = mysqli_num_rows($dados);
	
	if($total==0) {
		echo'<br>Evento não encontrado, revise o nome';
		
		echo"\n <br><hr><a href='perfil.php'>VOLTAR</a>";
		exit();
	}
	
	
	
	$linha = mysqli_fetch_array($dados);
	

		$login = $_SESSION['login'];
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

		if($classificacao_indicativa == 0) {
			$classificacao_indicativa = "Livre";
		}
        		
		   echo "
		   <head>
  <!-- Required meta tags -->
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

  <!-- Bootstrap CSS -->
  <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
  <link rel='stylesheet' href='./styles/styles.css'> 
  <link rel='stylesheet' href='./styles/reset.css'>
    <link rel='stylesheet' href='./styles/eventostyle.css'>
  <title>Qual é a boa?</title>
  <link REL='SHORTCUT ICON' HREF='assets/favicon.ico'>
</head>

<body>
  <nav class='navbar navbar-expand-lg navbar-light bg-light'>
    <a class='navbar-brand' href='index.php'>
    <img src='assets/logofc.png' width='100' height='100' class='d-inline-block align-top' alt=''>
    <!-- Bootstrap -->
  </a>
    <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
    <span class='navbar-toggler-icon'></span>
  </button>

  <div id='menu'>
    <ul>
        <li><a href='#Nit'>EDITAR EVENTO</a></li>
        <li><a href='#ita'>Itaboraí</a></li>
        <li><a href='#sg'>São Gonçalo</a></li>
        <li><a href='#mar'>Maricá</a></li>
        <li><a href='#rj'>Rio de Janeiro</a></li>
    </ul>
</div>

    <div class='collapse navbar-collapse' id='navbarSupportedContent'>
      <div class='mr-auto'></div>
      <ul class='navbar-nav my-2 my-lg-0'>
<li class='nav-item active'>
        <a class='nav-link' href='criarevento.php'>Criar um evento <span class='sr-only'>(current)</span></a>
      </li>

      

        <li class='nav-item dropdown'>
          <a class='nav-link dropdown-toggle' href='perfil.php' id='navbarDropdown' role='button' data-display='static' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            $login
        </a>
          <div class='dropdown-menu dropdown-menu-lg-right' aria-labelledby='navbarDropdown'>
            <h6 class='dropdown-header'>
                $login
            </h6>
            <a class='dropdown-item' href='#'>Meu perfil</a>
            <a class='dropdown-item' href='#'>Ajuda</a>
            <a class='dropdown-item' href='#'>Sair</a>
          </div>

        </li>

      </ul>

      </div>
  </nav>
<body>

<form action='evento.php' method ='get'>
    <div class='card mb-3'>
      <div class='row g-0'>
        <div class='col-md-4'>
          <img src='assets/bfrcrp.jpg' class='img-fluid rounded-start' alt='...''>
        </div>
        <div class='col-md-8'>
          <div class='card-body'>
            <p class='name-event'>$nome_evento</p>
            <b>Endereço:</b> $local_evento <br>
            <b>Cidade:</b> $cidade <br>
            <b>Data:</b> $data_evento <br>
            <b>Hora:</b> $hora <br>
            <b>Preço:</b> R$$preco <br>
            <b>Classificação Indicativa:</b> $classificacao_indicativa <br>
            <b>Assunto:</b> $assunto <br>
            <b>Autor:</b> $autor <br>
            <br><br>
            <div class='descricao'>
            <b><h4>Descrição do evento:</h4></b>
            <br>
            <p class='card-text'>$descricao
              </p>
            </div>
            <br>
            <input class='interesse' type='button' value='Tenho interesse'>
			<input type='hidden' name='entrada' value='0'>
			<input type='hidden' name='nome_evento' value='$nome_evento'>

				"; 				
					if($autor == $login) :
				echo "
					<button name='op' value='Editar' class='login100-form-btn'>
						Editar meu evento
					</button>			
					
					<button name='op' value='Excluir' class='login100-form-btn'>
						Excluir meu evento
					</button>
				";
					endif;
				echo "

          </div>
        </div>
      </div>
</form>
</body>

";
		 
		 $linha = mysqli_fetch_assoc($dados);

		 
		echo"\n <br><hr><a href='index.php'>VOLTAR</a>";
		exit();
	
}
function formPesquisarAlterar() {
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>ALTERAÇÃO DE EVENTO</h1></center>
    <HR>
	    <form action='evento.php' method='GET'>
		    <br>DIGITE O NOME DO EVENTO:<input type='text' name='nome_evento'> <br>
            <input type='hidden' name='op' value='4'>
		    <input type='hidden' name='entrada' value='2'>
		    <input type='submit' name='enviar' value='ENVIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>
        </form>
    </body>
    </html>	
	";	
	}

function formAlterar() {
	
	$nome_evento = $_GET['nome_evento'];
	$login = $_SESSION['login'];

	$conn = conectar();


	$sql = "SELECT * FROM evento WHERE '$nome_evento' = nome_evento";
	
	$dados = mysqli_query($conn,$sql);
	$total = mysqli_num_rows($dados);
	
	if($total==0) {
		echo'<br>Evento não encontrado. Tente novamente';
		
		echo"\n <br><hr><a href='index.php'>VOLTAR</a>";
		exit();
	}
	
    $linha = mysqli_fetch_array($dados);
	
	$nome_evento =    $linha['nome_evento'];		
	$local_evento = $linha['local_evento'];		
	$cidade = $linha['cidade'];		
	$data_evento =  $linha['data_evento'];		
	$hora = $linha['hora'];		
	$preco =   $linha['preco'];	
    $classificacao_indicativa = $linha['classificacao_indicativa'];		 
	$assunto = $linha['assunto'];
	$descricao = $linha['descricao'];
	$autor = $linha['autor'];
	
	if($autor != $login) {

		header('Location: index.php');
		exit();

	}


	echo "
	<html>
	<head>
	  <title>Qual é a boa?</title>
	  <link REL='SHORTCUT ICON' HREF='assets/favicon.ico'>
	  <script src= 'https://code.jquery.com/jquery-1.12.4.min.js'></script>
	  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.4.1/css/all.css' integrity='sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz' crossorigin='anonymous'>
	  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet'>
	  <style>
		html, body {
		min-height: 100%;
		/* background-image: linear-gradient(to right, #a619b3, #4796a8, #bbff9c);; */
		background-color: rgb(255, 255, 255);
		}
		body, div, form, input, select, p { 
		padding: 0;
		margin: 0;
		outline: none;
		font-family: Roboto, Arial, sans-serif;
		font-size: 16px;
		color: rgb(0, 0, 0);
		}
		body {
		background: url('/uploads/media/default/0001/01/b5edc1bad4dc8c20291c8394527cb2c5b43ee13c.jpeg') no-repeat center;
		background-size: cover;
		}
		h1, h2 {
		text-transform: uppercase;
		font-weight: 400;
		}
		h2 {
		margin: 0 0 0 8px;
		}
		.main-block {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		height: 100%;
		padding: 25px;
		background: rgba(0, 0, 0, 0.5); 
		}
		.left-part, form {
		padding: 25px;
		}
		.left-part {
		text-align: center;
		}
		.fa-graduation-cap {
		font-size: 72px;
		}
		/* form {
		 background: rgba(0, 0, 0, 0.7);  
		} */
		.lab {
		padding: 8px 10px;
		height: 20px;
		width: 180px;
		background-color: #ffffff;
		/* background-color: #333; */
		color: rgb(0, 0, 0);
		font-family: 'Josefin Sans', sans-serif;
		text-transform: uppercase;
		text-align: center;
		display: block;
		margin-top: 5px;
		cursor: pointer;
		border-radius: 25px;
  }
		
		.title {
		display: flex;
		align-items: center;
		margin-bottom: 20px;
		}
		.info {
		display: flex;
		flex-direction: column;
		}
		input, select {
		padding: 5px;
		margin-bottom: 30px;
		background: transparent;
		border: none;
		border-bottom: 1px solid rgb(136, 116, 116);
		color: black;
		}
		input::placeholder {
		/* color: #cfbebe; */
		color: black;
		}
		option:focus {
		border: none;
		}
		option {
		background: white; 
		border: none;
		}
		#assunto, .espec, #cidade {
		  color: rgb(136, 116, 116);
		}
		.checkbox input {
		margin: 0 10px 0 0;
		vertical-align: middle;
		}
		.checkbox a {
		color: #26a9e0;
		}
		.checkbox a:hover {
		color: #85d6de;
		}
		.btn-item, button {
		padding: 10px 5px;
		margin-top: 20px;
		border-radius: 5px; 
		border: none;
		/* background: #26a9e0;  */
		background: black;
		text-decoration: none;
		font-size: 15px;
		font-weight: 400;
		color: #fff;
		}
		.btn-item {
		display: inline-block;
		margin: 20px 5px 0;
		}
		button {
		width: 100%;
		}
		/* button:hover, .btn-item:hover {
		background: #85d6de;
		} */
		@media (min-width: 568px) {
		html, body {
		height: 100%;
		}
		.main-block {
		flex-direction: row;
		height: calc(100% - 50px);
		}
		.left-part, form {
		flex: 1;
		height: auto;
		}
		}
	  </style>
	</head>
	<body>
		<form action='evento.php' method='get'>
		  <div class='title'>
			<i class='fas fa-pencil-alt'></i> 
			<h1>   Editar meu evento</h1>
		  </div>
		  <div class='info'>
			  <label>Nome do evento:</label>
				  <input readonly class='fname' type='text' name='nome_evento' value='$nome_evento'>
			  <label>Endereço: </label> 
				  <input type='text' name='local_evento' value='$local_evento' required>
			  <label>Cidade: </label>
			  <select id='cidade' name='cidade' value='$cidade'>
				  <option value='Niterói'>Niterói</option>
				  <option value='Itaboraí'>Itaboraí</option>
				  <option value='São Gonçalo'>São Gonçalo</option>
				  <option value='Maricá'>Maricá</option>
				  <option value='Rio de Janeiro'>Rio de Janeiro</option>
			  </select>
				 
			  <label>Data: </label>
				  <input type='date' name='data_evento' value='$data_evento' class='espec' required>
			  <label>Hora: </label>
				  <input type='time' name='hora' value='$hora' class='espec' required>
			  <label>Preço: </label>
				  <input type='text' name='preco' value='$preco' required>
			  <label>Classificação Indicativa: </label>
				  <input type='int' name='classificacao_indicativa' value='$classificacao_indicativa' required>
			  <label>Assunto: </label>
			  <select id='assunto' value='$assunto' name='assunto'>
				  <option value='Acadêmico'>Acadêmico</option>
				  <option value='Nerd/Geek'>Nerd/Geek</option>
				  <option value='Artesanato'>Artesanato</option>
				  <option value='Cinema'>Cinema</option>
				  <option value='Show'>Show</option>
				  <option value='Esportes'>Esportes</option>
				  <option value='Gastronomia'>Gastronomia</option>
				  <option value='Política'>Política</option>
				  <option value='Saúde'>Saúde</option>
				  <option value='Festa'>Festa</option>
				  <option value='Tecnologia'>Tecnologia</option>
				</select>
				<label>Coloque um arquivo de foto do seu evento:</label>
			  <!-- <label class='lab' for='arquivo'>Enviar arquivo</label> -->
			  <input type='file' name='arquivo' id='arquivo' accept='image/*'>
			  <h4><!-- Selected file will get here --></h4>
			  <script>
				  $(document).ready(function() {
				  $('input[type='file']').change(function(e) {
				  var arquivo = e.target.files[0].name; 
				  $('h4').text('O arquivo ' + ( arquivo ) + ' foi selecionado');
			  });
			  });
			  </script>
			  <label>Descrição: </label>
				  <br>
				  <textarea class='descricao' cols='35' rows='8' name='descricao' value='$descricao'>

				  </textarea><br>
			  <label>Autor: </label>
				  <input readonly required name='autor' value='$autor'>
				  <input type='hidden' name='op' value='1'>
		  </div>
		  <input type='hidden' name='op' value='ExecAlterar'>
			<input type='hidden' name='entrada' value='0'>
		    <input type='submit' name='enviar' value='ENVIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>
			<br><a href='index.php'>VOLTAR</a>
		</form>
	  </div>
	</body>
  </html>

    ";

}
function execAlterar() {
	
	$nome_evento = $_GET['nome_evento'];		
	$local_evento = $_GET['local_evento'];		
	$cidade = $_GET['cidade'];		
	$data_evento =  $_GET['data_evento'];		
	$hora = $_GET['hora'];		
	$preco =   $_GET['preco'];	
    $classificacao_indicativa = $_GET['classificacao_indicativa'];		 
	$assunto = $_GET['assunto'];
	$descricao = $_GET['descricao'];	
	$autor = $_SESSION['login'];
	
	$sql = "UPDATE evento SET nome_evento='$nome_evento', local_evento='$local_evento', cidade='$cidade', data_evento='$data_evento', hora='$hora', preco='$preco', classificacao_indicativa='$classificacao_indicativa', assunto='$assunto', descricao='$descricao' WHERE '$nome_evento' = nome_evento";

	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	
	if($status) {
	    echo "<br>Registro de evento alterado";
		echo "<br><hr><a href='index.php'>VOLTAR</a>";
	}else {
	    echo "<br>Erro na alteração";
	
		echo "<br><hr><a href='index.php'>VOLTAR</a>";
	}	
}
function formExcluir() {
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>EXCLUSÃO DE EVENTO</h1></center>
    <HR>
	    <form action='evento.php' method='GET'>
		    <br>DIGITE O NOME DO EVENTO:<input type='text' name='nome_evento'> <br>
            <input type='hidden' name='op' value='5'>
		    <input type='hidden' name='entrada' value='2'>
		    <input type='submit' name='enviar' value='ENVIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>			
        </form>
    </body>
    </html>	
	";
	}

function execConfirmacaoExcluir() {
    $nome_evento = $_GET['nome_evento'];
    
	$conn = conectar();
    
    $sql = "SELECT * FROM evento WHERE '$nome_evento' = nome_evento";

    $dados = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    $total = mysqli_num_rows($dados);
 
    if($total==0) {
        echo '<br>EVENTO não encontrado';

        echo "\n <br><hr><a href='index.php'>VOLTAR</A>"; 
        exit();
    }

    $linha = mysqli_fetch_array($dados); 

	$nome_evento =    $linha['nome_evento'];		
	$local_evento = $linha['local_evento'];		
	$cidade = $linha['cidade'];		
	$data_evento =  $linha['data_evento'];		
	$hora = $linha['hora'];		
	$preco =   $linha['preco'];	
    $classificacao_indicativa = $linha['classificacao_indicativa'];		 
	$assunto = $linha['assunto'];
	$descricao = $linha['descricao'];
	$autor = $linha['autor'];

	// if($autor != $login) {
		

	// 	header('Location: index.php');
	// 	exit();

	// }
	

    echo
    "<html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>DESEJA REALMENTE EXCLUIR $nome_evento?</h1></center>
    <HR>
        <form action='evento.php' method='GET'>
  

            <input type='hidden' name='op' value='Excluir'> 
            <input type='hidden' name='entrada' value='3'>   
			<input type='hidden' name='nome_evento' value='$nome_evento'>  
            <input type='submit' name='enviar' value='EXCLUIR'>
            <br><hr><a href='index.php'>VOLTAR</A>
        </form>
    </body>
    </html>";
}
function execExcluir() {
	
	$nome_evento = $_GET['nome_evento'];
	
	$conn = conectar();
	
	$sql = "DELETE FROM evento WHERE '$nome_evento' = nome_evento";
	
	$status = mysqli_query($conn,$sql);
	
	if($status)
	    echo "<br>Registro de evento excluído";
	else
	    echo "<br>Erro na exclusão";
	
	echo "<br><hr><a href='index.php'>VOLTAR</a>";
		
}	
?>