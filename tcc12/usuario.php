<?php
require_once("banco.php");
$operacao = $_GET['op'];

switch($operacao){
		case "registrar":
				execIncluir();    
			break;
		case 2:  // listar
			execListar();
			break;
		case 3:  // pesquisar
			$entrada = $_GET['entrada'];
			if($entrada == 1) 
				formPesquisar();
			if($entrada == 2)
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
	
function formIncluir() {
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>CADASTRO DE USUÁRIO</h1></center>
    <HR>
	    <form action='usuario.php' method='GET'>
		    PREENCHA OS DADOS: <BR>
			<br>LOGIN: <input type='text' name='login'> <br>
			<br>NOME: <input type='text' name='nome_usuario'> <br>
			<br>SOBRENOME: <input type='text' name='sobrenome'> <br>
			<br>E-MAIL: <input type=email name='email'> <br>			
			<br>SENHA: <input type='password' name='senha'> <br>
			<br>DATA DE NASCIMENTO: <input type='date' name='data_nascimento'> <br>
			<br>CPF:<input type='cpf' name='cpf'> <br>
            <input type='hidden' name='op' value='1'>
		    <input type='hidden' name='entrada' value='2'>
		    <input type='submit' name='enviar' value='CRIAR'>
		    <input type='reset' name='limpar' value='LIMPAR'>
        </form>
    </body>
    </html>	
    ";

}
function execIncluir() {
	
	$login = $_GET['login'];
	$nome_usuario = $_GET['nome_usuario'];
	$sobrenome = $_GET['sobrenome'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$data_nascimento = $_GET['data_nascimento'];
	$cpf = $_GET['cpf'];
	
	
	
	$sql = "INSERT INTO usuario (login, nome_usuario, sobrenome, email, senha, data_nascimento, cpf) values('$login', '$nome_usuario', '$sobrenome', '$email', '$senha', '$data_nascimento', '$cpf')";

	$infos = "As seguintes especificações foram adicionadas:
	<br><br>
	<b>Login:</b> $login <br>
	<b>Nome:</b> $nome_usuario <br>
	<b>Sobrenome:</b> $sobrenome <br>
	<b>E-mail:</b> $email <br>
	<b>senha:</b> $senha <br>
	<b>data_nascimento:</b> $data_nascimento <br>
	<b>CPF:</b> $cpf <br>";
	
	
	
	echo $infos;
	
	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	
	if($status)
	    echo "<br>Usuário cadastrado com sucesso!";
	else
	    echo "<br>ERRO AO REALIZAR O CADASTRO. TENTE NOVAMENTE";
	
	echo "<br><hr><a href='index.php'>VOLTAR</a>";
		
	
}
function execListar(){
	
	$sql = "select * from usuario";
	
	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	$total = mysqli_num_rows($status);
	
	echo"<center><table border=1 width=80%>";
	echo"<TR><TH>LOGIN</TH><TH>NOME</TH><TH>SOBRENOME</TH><TH>E-MAIL</TH><TH>SENHA</TH><TH>DATA DE NASCIMENTO</TH><TH>CPF</TH></TR>";
	
	$linha = mysqli_fetch_array($status);
	
	for($i=0; $i<$total; $i++) {

	$login = $linha['login'];
	$nome_usuario = $linha['nome_usuario'];
	$sobrenome = $linha['sobrenome'];
	$email = $linha['email'];
	$senha = $linha['senha'];
	$data_nascimento = $linha['data_nascimento'];
	$cpf = $linha['cpf'];

    
		 echo"<tr><td>$login</td><td>$nome_usuario</td><td>$sobrenome</td><td>$email</td><td>$senha</td><td>$data_nascimento</td><td>$cpf</td></tr>";
		 $linha = mysqli_fetch_assoc($status);
	}
	echo "</table></center>";
	echo "<br><hr><a href= 'index.html'>VOLTAR</a>";
	
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
	    <form action='usuario.php' method='GET'>
		    <br>DIGITE O SEU CPF:<input type='text' name='cpf' autocomplete='on'> <br>
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
    
	$cpf = $_GET['cpf'];
	
	
	$conn = conectar();

	$sql = "SELECT * FROM usuario WHERE '$cpf'=cpf";
	
	$dados = mysqli_query($conn,$sql) or die (mysqli_error($conn));
	$total = mysqli_num_rows($dados);
	
	if($total==0) {
		echo'<br>Usuário não encontrado, revise o cpf';
		
		echo"\n <br><hr><a href='index.html'>VOLTAR</a>";
		exit();
	}
	
	echo"\n <center><table border=1 width=80%>";
	echo"\n <TR><TH>LOGIN</TH><TH>NOME</TH><TH>SOBRENOME</TH><TH>E-MAIL</TH><TH>SENHA</TH><TH>DATA DE NASCIMENTO</TH><TH>CPF</TH></TR>";
	
	$linha = mysqli_fetch_array($dados);
	
	for($i=0; $i<$total; $i++) {
		
	$login = $linha['login'];
	$nome_usuario = $linha['nome_usuario'];
	$sobrenome = $linha['sobrenome'];
	$email = $linha['email'];
	$senha = $linha['senha'];
	$data_nascimento = $linha['data_nascimento'];
	$cpf = $linha['cpf'];
        		
		 echo"<tr><td>$login</td><td>$nome_usuario</td><td>$sobrenome</td><td>$$email</td><td>$senha</td><td>$data_nascimento</td><td>$cpf</td></tr>";
		 $linha = mysqli_fetch_assoc($dados);
		 
		echo"\n <br><hr><a href='index.html'>VOLTAR</a>";
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
	    <form action='usuario.php' method='GET'>
		    <br>DIGITE O CPF:<input type='cpf' name='cpf'> <br>
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
	
	$cpf = $_GET['cpf'];
	
	$conn = conectar();
	
	$sql = "SELECT * FROM usuario WHERE '$cpf' = cpf";
	
	$dados = mysqli_query($conn,$sql);
	$total = mysqli_num_rows($dados);
	
	if($total==0) {
		echo'<br>Evento não encontrado. Tente novamente';
		
		echo"\n <br><hr><a href='index.html'>VOLTAR</a>";
		exit();
	}
	
    $linha = mysqli_fetch_array($dados);
	
	$login = $linha['login'];
	$nome_usuario = $linha['nome_usuario'];
	$sobrenome = $linha['sobrenome'];
	$email = $linha['email'];
	$senha = $linha['senha'];
	$data_nascimento = $linha['data_nascimento'];
	$cpf = $linha['cpf'];
	
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>ALTERAÇÃO DE USUARIO</h1></center>
    <HR>
	    <form action='usuario.php' method='GET'>
		    PREENCHA OS DADOS: <BR>
			
			<br>LOGIN:<input type='text' name='login' value='$login'> <br>
			<br>Nome:<input type='text' name='nome_usuario' value='$nome_usuario'> <br>
		    <br>Sobrenome:<input type='text' name='sobrenome' value='$sobrenome'> <br>
		    <br>E-mail:<input type='email' name='email' value='$email'> <br>
			<br>SENHA:<input type='password' name='senha' value='$senha'> <br>
			<br>DATA DE NASCIMENTO:<input type='date' name='data_nascimento' value='$data_nascimento'> <br>
			<br>CPF:<input type='cpf' name='cpf' value='$cpf'> <br>
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
	
	$login = $_GET['login'];
	$nome_usuario = $_GET['nome_usuario'];
	$sobrenome = $_GET['sobrenome'];
	$email = $_GET['email'];
	$senha = $_GET['senha'];
	$data_nascimento = $_GET['data_nascimento'];
	$cpf = $_GET['cpf'];	
	
	$sql = "UPDATE usuario SET login='$login', nome_usuario='$nome_usuario', sobrenome='$sobrenome', email='$email', senha='$senha', data_nascimento='$data_nascimento', cpf='$cpf' WHERE '$cpf' = cpf";

	$conn = conectar();
	
	$status = mysqli_query($conn,$sql);
	
	if($status) {
	    echo "<br>Registro de usuário alterado";
		echo "<br><hr><a href='index.html'>VOLTAR</a>";
	}else {
	    echo "<br>Erro na alteração";
	
		echo "<br><hr><a href='index.html'>VOLTAR</a>";
	}	
}
function formExcluir() {
	
	echo "
    <html>
    <head>
	    <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>EXCLUSÃO DE USUARIO</h1></center>
    <HR>
	    <form action='usuario.php' method='GET'>
		    <br>DIGITE O CPF:<input type='text' name='cpf'> <br>
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
	$cpf = $_GET['cpf'];
    
	$conn = conectar();
    
    $sql = "SELECT * FROM usuario WHERE '$cpf' = cpf";

    $dados = mysqli_query($conn,$sql) or die (mysqli_error($conn));
    $total = mysqli_num_rows($dados);
 
    if($total==0) {
        echo '<br>USUARIO não encontrado';

        echo "\n <br><hr><a href='index.html'>VOLTAR</A>"; 
        exit();
    }

    $linha = mysqli_fetch_array($dados); 

	$login = $linha['login'];
	$nome_usuario = $linha['nome_usuario'];
	$sobrenome = $linha['sobrenome'];
	$email = $linha['email'];
	$senha = $linha['senha'];
	$data_nascimento = $linha['data_nascimento'];
	$cpf = $linha['cpf'];


    echo
    "<html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
    <center><h1>EXCLUSÃO DE USUARIO</h1></center>
    <HR>
        <form action='usuario.php' method='GET'>
            PREENCHA OS DADOS: <BR>
			
			<br>LOGIN:<input type='text' name='login' value='$login'> <br>
			<br>Nome:<input type='text' name='nome_usuario' value='$nome_usuario'> <br>
		    <br>Sobrenome:<input type='text' name='sobrenome' value='$sobrenome'> <br>
		    <br>E-mail:<input type='email' name='email' value='$email'> <br>
			<br>SENHA:<input type='password' name='password' value='$senha'> <br>
			<br>DATA DE NASCIMENTO:<input type='date' name='data' value='$data_nascimento'> <br>
			<br>CPF:<input type='cpf' name='cpf' value='$cpf'> <br>	

            DESEJA REALMENTE EXCLUIR SEU PERFIL? <br><br>    

            <input type='hidden' name='op' value='5'> 
            <input type='hidden' name='entrada' value='3'>    
            <input type='submit' name='enviar' value='EXCLUIR'>
            <br><hr><a href='index.html'>VOLTAR</A>
        </form>
    </body>
    </html>";
}
function execExcluir() {
	
	$cpf = $_GET['cpf'];
	
	$conn = conectar();
	
	$sql = "DELETE FROM usuario WHERE '$cpf' = cpf";
	
	$status = mysqli_query($conn,$sql);
	
	if($status)
	    echo "<br>Registro de usuario excluído";
	else
	    echo "<br>Erro na exclusão";
	
	echo "<br><hr><a href='index.html'>VOLTAR</a>";
		
}	
