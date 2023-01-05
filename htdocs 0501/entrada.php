<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qual é a boa?</title>
	<link REL="SHORTCUT ICON" HREF="assets/favicon.ico">

        <link rel="stylesheet" type="text/css" href="styles/util.css">
        <link rel="stylesheet" type="text/css" href="styles/main.css">
		<style>
			#pau {
				visibility: hidden;
			}
			.login100-form-btn {
				padding-left: 52px; 
				
			}
		</style>

</head>
<body>
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action="login.php" method="post">
					<span class="login100-form-title p-b-26">
						Login
					</span>

                    <?php
                    if(isset($_SESSION['nao_autenticado'])):
                    ?>
                    <p> ERRO: Usuário ou senha inválidos. </p>
                    <?php
                    unset($_SESSION['nao_autenticado']);
                    endif;
                    ?>

					<span class="login100-form-title p-b-48">
						<!-- <i class="zmdi zmdi-font"></i> -->
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="text" id="login" name="login">
						<span class="focus-input100" data-placeholder="Login de usuário"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password" minlength="8" required>						
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Entrar
								<input type="submit" class="btn btn-dark ppp" id="pau" value="Entrar">
							</button>
						</div>
					</div>

					<div class="text-center p-t-115">
						<span class="txt1">
							Não tem cadastro?
						</span>

						<a class="txt2" href="cadastro.php">
							Registre-se
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
    
</body>
</html>