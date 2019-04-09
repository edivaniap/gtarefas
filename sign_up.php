<?php
$MESSAGE = "";
$ERROR = "";

if(isset($_POST["submit"])) {
  if($_POST["pass"] == $_POST["confpass"]) {
    $file_path = "js/users.json";
    if(file_exists($file_path)) {
      //carrega dados atuais do json
      $dados_atuais = file_get_contents($file_path);
      //traduz os dados para $arrayName = array('' => , );
      $array_dados = json_decode($dados_atuais, true);

      //verifica se ja tem usuario com o mesmo username
      if(exists($_POST["username"], $array_dados)) {
        $ERROR = "<label style='color: red'>O nome de usu está indisponível.</label>";
      } else {
        //pega os dados do ususario que vai ser inserido
        $temp = array(
          "name" => $_POST["name"],
          "bio" => $_POST["bio"],
          "username" => $_POST["username"],
          "password" => $_POST["pass"]
        );
        //insere o dado no array
        $array_dados[] = $temp;
        //traduz o array para json e armazena em dados_final
        $dados_final = json_encode($array_dados);

        //escreve no json e verifica se funcionou
        if(file_put_contents($file_path, $dados_final)) {
          $MESSAGE = "<label style='color: green'>Você foi cadastrado com sucesso.</label>";
        } else {
          $ERROR = "<label style='color: red'>Erro ao tentar inserir usuário nos nossos dados.</label>";
        }
      }
    } else {
      $ERROR = "<label style='color: red'>Arquivo de dados de usuários não existe.</label>";
    }
  } else {
    $ERROR = "<label style='color: red'>A confrimação da senha não confere.</label>";
  }
}
/*
 * verifica se existe dado em um array
 */
function exists($chave, $array) {
  foreach ($array as $element) {
    if($element["username"] == $chave)
      return true;
  }
  return false;
}

?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>GTarefas - Novo projeto</title>
    <!-- <script src="js/sign_up_script.js"></script> -->
</head>

<body>
	<header>
		<h1 style="text-align: center;">GERENCIADOR DE TARFEAS</h1>
		<h4 style="text-align: center;">(To-do List)</h4>
	</header>

	<section>
		<center>
			<br>
		<h2>Cadastre-se</h2>
		<br>
		<form method="POST">
      <?php
      if(isset($ERROR))
        echo $ERROR;

      if(isset($MESSAGE))
        echo $MESSAGE;
      ?>
			<table cellspacing="10">
				<tr>
					<th style="text-align: right;">Nome:</th>
					<td><input type="text" id="name" name="name" required></td>
				</tr>
				<tr>
					<th style="text-align: right;">Bio: </th>
					<td><input type="text" id="bio" name="bio"></td>
				</tr>
				<tr>
					<th style="text-align: right;">Nome de usuário:</th>
					<td><input type="text" id="username" name="username" required></td>
				</tr>
				<tr>
					<th style="text-align: right;">Senha:</th>
					<td><input type="password" id="pass" name="pass" required></td>
				</tr>
				<tr>
					<th style="text-align: right;">Confirmar senha:</th>
					<td><input type="password" id="confpass" name="confpass" required></td>
				</tr>
			</table>
			<div id="loading"></div>
			<!-- <button id="signup" onclick="ajaxAddUser()">Cadastrar</button> -->
      <input type="submit" id="submit" name="submit" value="Cadastrar">
		</form>
    <p>Já está cadastrado? <a href="sign_in.html">Fazer login</a>.</p>
		</center>
	</section>

	<footer style="text-align: center; position: fixed; bottom: 10px; width: 100%">
		<p>
			Desenvolvimento Web I @ 2019.1 - Pontes © <br>
			Contato: <a href="mailto:edivaniap@ufrn.edu.br">✉ edivaniap</a>
		</p>
	</footer>
</body>
</html>
