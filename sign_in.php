<?php
$ERROR = "";

if(isset($_POST["submit"])) {
  $file_path = "js/users.json";

  if(file_exists($file_path)) {
    $dados_atuais = file_get_contents($file_path);
    //traduz os dados para $arrayName = array('' => , );
    $array_dados = json_decode($dados_atuais, true);

    $user_logando = "";

    foreach ($array_dados as $element) {
      if($element["username"] == $_POST["user"] && $element["username"] == $_POST["pass"])
        $user_logando = $element["username"];
    }

    if($user_logando == "") {
      $ERROR = "<label style='color: red'>Desculpa. Você não está cadastrado ou suas credenciais não conferem.</label>";
    } else {
      //inicia sessao
      session_start();
      //set o usuario da sessao
      $_SESSION["user_session"] = $user_logando;
      //redireciona para tela inicial do ususario
      header('Location: home.php');
    }

  } else {
    $ERROR = "<label style='color: red'>Arquivo de dados de usuários não existe.</label>";
  }
?>

<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>GTarefas</title>
</head>

<body>
	<header>
		<h1 style="text-align: center;">GERENCIADOR DE TARFEAS</h1>
		<h4 style="text-align: center;">(To-do List)</h4>
	</header>
	<section>
		<center>
		<form method="POST">
      <?php
      if(isset($ERROR))
        echo $ERROR;
      ?>
			<div id="loading"></div>
			Usuário:
			<input type="text" id="user" name="user"><br>
			Senha:
			<input type="password" id="pass" name="pass"><br><br>

			<input type="submit" value="Entrar">
		</form>

    <p>Não é cadastrado? <a href="sign_up.php">Cadastre-se</a>.</p>
		</center>
	</section>

	<footer>
		<p style="text-align: center;">Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
	</footer>
</body>
</html>
