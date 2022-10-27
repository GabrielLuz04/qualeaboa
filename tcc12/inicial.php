<?php
require_once("banco.php");
$operacao = $_GET['op'];
    
	if ($operacao==1){
		
	echo "

<html>
    <head>
        <meta charset='utf-8'>
    </head>
    <body>
        <center><h1>QUAL É A BOA?</h1></center>
        <HR>
            <form action='evento.php' method='GET'>
                ESCOLHA A OPÇÃO: <BR>
                <input type='radio' name='op' value='1'>INCLUIR <BR>
                <input type='radio' name='op' value='2'>LISTAR <BR>         
                <input type='radio' name='op' value='3'>PESQUISAR <BR>          
                <input type='radio' name='op' value='4'>ALTERAR <BR> 
                <input type='radio' name='op' value='5'>EXCLUIR <BR>  
                
                <input type='hidden' name='entrada' value='1'>    
                <input type='submit' name='enviar' value='ENVIAR'> 
                <input type='reset' name='limpar' value='LIMPAR'> 
            </form>
    </body>
</html>

";
	}
