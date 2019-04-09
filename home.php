<?php
$ERROR = "";

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

$USER_LOG = "edi";
$USER_OBJ = getUser($USER_LOG);
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

	<!--<nav style="text-align: center;">
		<ul style="display: inline;">
			<li style="display: inline;"><a href="#">Adicionar</a></li>
			<li style="display: inline;"><a href="#">Minhas tarefas</a></li>
			<li style="display: inline;"><a href="#">Minhas tarefas</a></li>
		</ul>
	</nav>-->

	<section>
    <?php
    if(isset($ERROR))
      echo $ERROR;
    ?>
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
					<a href="add_project.php"><button><img src="images/add.png" alt="add"> Projeto</button></a>
				</td>
			<tr>
		</table>
	</section>

	<footer>
		<p style="text-align: center;">Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
	</footer>
</body>
</html>
