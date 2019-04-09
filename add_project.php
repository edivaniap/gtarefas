<?php
$ERROR = "";
$MESSAGE = "";
$USER_LOG = "edi"; //PEGAR ESSE DADO A PARTIR DE LOGIN

//RETORNA USUARIO A PARTIR DO SEU USERNAME
function getUser($key) {
  $file_path = "js/users.json";
  if(file_exists($file_path)) {
    //carrega dados atuais do json
    $curr_users = file_get_contents($file_path);
    //traduz os dados para $arrayName = array('' => , );
    $array_users = json_decode($curr_users, true);
    foreach ($array_users as $u) {
      if($u["username"] == $key) {
        return $u;
      }
    }
  } else {
    $ERROR = "<label style='color: red'>Arquivo de dados de usuários não existe.</label>";
  }
}

//ADICIONAR PROJETO NOVO
if(isset($_POST["submit"])) {
    $file_path = "js/users.json";
    //fopen($file_path, "w"); se n existe, usar em cad projeto
    if(file_exists($file_path)) {
      //carrega dados atuais do json
      $dados_atuais = file_get_contents($file_path);
      //traduz os dados para $arrayName = array('' => , );
      $array_dados = json_decode($dados_atuais, true);

        //buscar no array onde esta o usuario para adc projets
          for ($i = 0; $i < count($array_dados); $i++) {
            if($array_dados[$i]["username"] == $USER_LOG)
              array_push($array_dados[$i]["projects"], $_POST["projeto"]);
          }

        //traduz o array para json e armazena em dados_final
        $dados_final = json_encode($array_dados);

        //escreve no json e verifica se funcionou
        if(file_put_contents($file_path, $dados_final)) {
          $MESSAGE = "<label style='color: green'>Projeto adicionado com sucesso.</label>";
        } else {
          $ERROR = "<label style='color: red'>Erro ao tentar inserir projeto.</label>";
        }
    } else {
      $ERROR = "<label style='color: red'>Arquivo de dados de usuários não existe.</label>";
    }
}

$USER_OBJ = getUser($USER_LOG);
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>GTarefas - Novo projeto</title>
</head>

<body>
	<header>
		<h1 style="text-align: center;">GERENCIADOR DE TARFEAS</h1>
		<h4 style="text-align: center;">(To-do List)</h4>
	</header>

	<section>
		<table cellspacing="20">
			<tr>
				<td>
          <div style="border: 1px double black; width: 250px; text-align: center;">
						<img src="images/lisa.gif" alt="Lisa" style="width:200px;height:200px;">
						<h3><?php echo  $USER_OBJ["name"]?></h3>
						<p><?php echo  $USER_OBJ["bio"]?></p>
						<p><a href="sign_in.php"><button><img src="images/out.png" alt="out"> Sair</button></a></p>
					</div>
				</td>
				<td>
					<h3>Seus projetos:</h3>
					<ul>
            <?php
            $to_print = "";
            foreach ($USER_OBJ["projects"] as $projeto) {
                $to_print .= "<li><a href='project.php?p=" . $projeto . "'>" . $projeto . "</a>";
                $to_print .= "<a href='adc_tarefa_projeto_a.html'> <img src='images/add_task.png' alt='add' title='Nova tarefa'></a></li>";
            }

            if($to_print == "")
              $to_print = "<li>Sem projetos cadastrados.</li>";
            echo $to_print;
            ?>
					</ul>
					<a href="adc_projeto.html"><button><img src="images/add.png" alt="add"> Projeto</button></a>
				</td>
				<td style="width: 50%">
					<center>
            <?php
            if(isset($ERROR))
              echo $ERROR;

            if(isset($MESSAGE))
                echo $MESSAGE;
            ?>
					<h2>Novo projeto</h2>
					<form method="post">
						Título do projeto:
						<input type="text" id="projeto" name="projeto" required>
            <br>
            <br>
            <a href="home.php"><button>Voltar</button></a>
						<input type="submit" name="submit" value="Adicionar">

					</form>
          </center>
				</td>
			<tr>
		</table>
	</section>

	<footer>
		<center>
		<p>Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
		</center>
	</footer>
</body>
</html>
