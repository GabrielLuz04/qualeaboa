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
		case 4:  // alterar
			$entrada = $_GET['entrada'];
			if($entrada == 1)
				formPesquisarAlterar();
			if($entrada == 2)
				formAlterar();   
			if($entrada == 3)
				execAlterar();   
			break;
		case 5:  // excluir
			$entrada = $_GET['entrada'];            
			if($entrada == 1)
				formExcluir();
			if($entrada == 2)
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
		   <head>
		   <meta charset='UTF-8'>
		   <meta http-equiv='X-UA-Compatible' content='IE=edge'>
		   <meta name='viewport' content='width=device-width, initial-scale=1.0'>
		   <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css' rel='stylesheet' integrity='sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx' crossorigin='anonymous'>
		   <link rel='stylesheet' href='styles/eventostyle.css'>
		   <link REL='SHORTCUT ICON' HREF='assets/favicon.ico'>
		   <title>Qual é a boa?</title>
</head>
<body>

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
          </div>
        </div>
      </div>
    
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
	
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>ALTERAÇÃO DE EVENTOS</h1></center>
    <HR>
	    <form action='evento.php' method='GET'>
		    PREENCHA OS DADOS: <BR>
			
			<br>Nome do evento:<input type='text' name='nome_evento' value='$nome_evento'> <br>
		    <br>Endereço:<input type='text' name='local_evento' value='$local_evento'> <br>
		    <br>Cidade:<input type='text' name='cidade' value='$cidade'> <br>
			<br>DATA:<input type='date' name='data_evento' value='$data_evento'> <br>
			<br>Hora:<input type='text' name='hora' value='$hora'> <br>
			<br>Preço:<input type='int' name='preco' value='$preco'> <br>
			<br>Classificação Indicativa:<input type='int' name='classificacao_indicativa' value='$classificacao_indicativa'> <br>
			<br>Assunto:<input type='text' name='assunto' value='$assunto'> <br>
			<br>Descrição<input type='text' name='descricao' value='$descricao'> <br>
            <input type='hidden' name='op' value='4'>
		    <input type='hidden' name='entrada' value='3'>
		    <input type='submit' name='enviar' value='ENVIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>
        </form>
    </body>
    </html>	
    ";

}
function execAlterar() {
	
	$nome_evento =    $_GET['nome_evento'];		
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


    echo
    "<html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>EXCLUSÃO DE EVENTO</h1></center>
    <HR>
        <form action='evento.php' method='GET'>
            PREENCHA OS DADOS: <BR>
			
			<br>Nome do evento:<input type='text' name='nome_evento' value='$nome_evento'> <br>
		    <br>Endereço:<input type='text' name='local_evento' value='$local_evento'> <br>
		    <br>Cidade:<input type='text' name='cidade' value='$cidade'> <br>
			<br>DATA:<input type='date' name='data_evento' value='$data_evento'> <br>
			<br>Hora:<input type='text' name='hora' value='$hora'> <br>
			<br>Preço:<input type='int' name='preco' value='$preco'> <br>
			<br>Classificação Indicativa:<input type='int' name='classificacao_indicativa' value='$classificacao_indicativa'> <br>
			<br>Assunto:<input type='text' name='assunto' value='$assunto'> <br>
			<br>Descrição<input type='text' name='descricao' value='$descricao'> <br><br>	

            DESEJA REALMENTE EXCLUIR? <br><br>    

            <input type='hidden' name='op' value='5'> 
            <input type='hidden' name='entrada' value='3'>    
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