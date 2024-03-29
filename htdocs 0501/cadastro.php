<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link REL="SHORTCUT ICON" HREF="assets/favicon.ico">
    <title>Login</title>

	<link rel="stylesheet" type="text/css" href="./styles/util.css">
    <link rel="stylesheet" type="text/css" href="./styles/main.css">
	<link rel="stylesheet" type="text/css" href="./styles/main.css">
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
	
	
    <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" action ="usuario.php" method ="get">
					<span class="login100-form-title p-b-26">
						Cadastro
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

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="login" required autocomplet="off">
						<span class="focus-input100" data-placeholder="Login"></span>
					</div>
					
					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="nome_usuario" required>
						<span class="focus-input100" data-placeholder="Primeiro nome"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="sobrenome" required>
						<span class="focus-input100" data-placeholder="Sobrenome"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="email" name="email" required>
						<span class="focus-input100" data-placeholder="E-mail"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="senha" required>
						<span class="focus-input100" data-placeholder="Senha"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="confirmsenha" minlength="8" required>
						<span class="focus-input100" data-placeholder="Confirme sua senha" minlength="8"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="date" name="data_nascimento" required>
						<span class="focus-input100" data-placeholder=""></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is: a@b.c">
						<input class="input100" type="int" name="cpf" required>
						<span class="focus-input100" data-placeholder="CPF"></span>
					</div>

				<!-- <h5>Coloque um arquivo de foto sua aqui:</h5>
            	<label class="lab" for="arquivo">Enviar arquivo</label>
            	<input type="file" name="arquivo" id="arquivo" accept="image/*">
            	<h4> Selected file will get here </h4>
            	<script>
                $(document).ready(function() {
                $('input[type="file"]').change(function(e) {
                var arquivo = e.target.files[0].name; 
                $("h4").text('O arquivo ' + ( arquivo ) + ' foi selecionado.');
            });
            });
            </script> -->

					
	
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button name="op" value="Registrar" class="login100-form-btn">
								Cadastrar
							</button>
						</div>
					</div>
		

					<div class="text-center p-t-115">
						<span class="txt1">
							Já possui Cadastro?
						</span>

						<a class="txt2" href="entrada.php">
							Faça login!
						</a>
					</div>

			
				</form>
			</div>
		</div>
	</div>

</head>
<body>
    <script src="./css/main.js"></script> 
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="js/main.js"></script>
    <script src="styles/main.js"></script>

</body>
</html>