<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>

<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./reset.css">
<link rel="stylesheet" href="style.css">
<title>QUAL É A BOA?</title>

</head>
<body>
    <div>
        <main>
            <h1>QUAL É A BOA?</h1>
            
            <div id="cc">
            
                <form class="card" action="login.php" method="post">
                
                <div class="card-header">
                <h2>Login</h2>    
                </div>
                <?php
                if(isset($_SESSION['nao_autenticado'])):
                ?>
                <p> ERRO: Usuário ou senha inválidos. </p>
                <?php
                unset($_SESSION['nao_autenticado']);
                endif;
                ?>
                <div class="es"> <input id="login" name="login" placeholder="Login"> </div>
                <div class="es"> <input type="password" id="password" name="password" placeholder="Senha"> </div>
                <br>                         
                <a href="#" class="recuperar_senha">Esqueceu a senha?</a>
                <br><br><br>
                <input type="submit" class="enviar" value="Entrar">
                <br><br>

                <!-- <button type="button" id="contaG" class="contas">Entrar com Google</button> 
                <br><br>
                <button type="button" id="contaF" class="contas">Entrar com Facebook</button> 
                <br><br> -->

                <div class="registra"><p> Não tem cadastro? <a href="cadastro.html" target="self"> Registre-se</a></p> </div>
                <br>

                <!-- <br><br>
                <a href="a" class="recuperar_senha">Esqueceu a senha?</a>
                <br><br> -->
                
                </form>
            </div>
        </main>
        <!-- <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/IFRJ_-_Campus_Niter%C3%B3i_2019.svg/2560px-IFRJ_-_Campus_Niter%C3%B3i_2019.svg.png" alt="Logo do Ifrj Campus Niterói" width="245" height="70" id="ifrj"> -->
    </div>
    
</body>
</html>