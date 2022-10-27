<?php
require_once("banco.php");
$operacao = $_GET['op'];
$entrada = $_GET['entrada'];

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
		case 3:
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
	
	
	$sql = "INSERT INTO evento (nome_evento, local_evento, cidade, data_evento, hora, preco, classificacao_indicativa, assunto, descricao) values('$nome_evento', '$local_evento', '$cidade', '$data_evento', '$hora', '$preco', '$classificacao_indicativa', '$assunto', '$descricao')";

	$infos = "As seguintes especificações foram adicionadas:
	<br><br>
	<b>Nome:</b> $nome_evento <br>
	<b>Local:</b> $local_evento <br>
	<b>Cidade:</b> $cidade <br>
	<b>Data:</b> $data_evento <br>
	<b>Hora:</b> $hora <br>
	<b>Preço:</b> R$ $preco <br>
	<b>Classificação indicativa:</b> $classificacao_indicativa anos <br>
	<b>Assunto:</b> $assunto <br>
	<b>Descrição:</b> $descricao<br>";
	
	
	
	echo $infos;
	
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
		 
		 echo"<tr><td>$nome_evento</td><td>$local_evento</td><td>$cidade</td><td>$data_evento</td><td>$hora</td><td>$preco</td><td>$classificacao_indicativa</td><td>$assunto</td><td>$descricao</td></tr>";
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
    
	$nome_evento = $_GET['nome_evento'];
	
	
	$conn = conectar();

	$sql = "SELECT * FROM evento WHERE '$nome_evento'=nome_evento";
	
	$dados = mysqli_query($conn,$sql) or die (mysqli_error($conn));
	$total = mysqli_num_rows($dados);
	
	if($total==0) {
		echo'<br>Evento não encontrado, revise o nome';
		
		echo"\n <br><hr><a href='index.php'>VOLTAR</a>";
		exit();
	}
	
	echo"\n <center><table border=1 width=80%>";
	echo"\n <TR><TH>NOME DO EVENTO</TH><TH>ENDEREÇO</TH><TH>CIDADE</TH><TH>DATA</TH><TH>HORA</TH><TH>PREÇO</TH><TH>CLASSIFICAÇÃO INDICATIVA</TH><TH>ASSUNTO</TH><TH>DESCRIÇÃO</TH></TR>";
	
	$linha = mysqli_fetch_array($dados);
	
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
        		
		 echo"<tr><td>$nome_evento</td><td>$local_evento</td><td>$cidade</td><td>$data_evento</td><td>$hora</td><td>$preco</td><td>$classificacao_indicativa</td><td>$assunto</td><td>$descricao</td></tr>";
		 $linha = mysqli_fetch_assoc($dados);
		 
		echo"\n <br><hr><a href='index.php'>VOLTAR</a>";
		exit();
	}
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