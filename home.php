<?php
$file_path = "js/tasks.json";
if(file_exists($file_path)) {
  //carrega dados atuais do json
  $curr_tasks = file_get_contents($file_path);
  //traduz os dados para $arrayName = array('' => , );
  $array_tasks = json_decode($curr_tasks, true);

  $USER_LOG = "edi";

  foreach ($array_tasks as $t) {
  //  if(t["user"] == $USER_LOG))
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

	<!--<nav style="text-align: center;">
		<ul style="display: inline;">
			<li style="display: inline;"><a href="#">Adicionar</a></li>
			<li style="display: inline;"><a href="#">Minhas tarefas</a></li>
			<li style="display: inline;"><a href="#">Minhas tarefas</a></li>
		</ul>
	</nav>-->

	<section>
		<table cellspacing="20">
			<tr>
				<td>
					<div style="border: 1px double black; width: 250px; text-align: center;">
						<img src="images/lisa.gif" alt="Lisa" style="width:200px;height:200px;">
						<h3>Lisa Simpson</h3>
						<p>Pensadora contemporânia</p>
						<p><a href="login.html"><button><img src="images/out.png" alt="out"> Sair</button></a></p>
					</div>
				</td>
				<td>
					<h3>Seus projetos:</h3>
					<ul>
						<li><a href="projeto_a.html">Projeto A</a> <a href="adc_tarefa_projeto_a.html"><img src="images/add_task.png" alt="add" title="Nova tarefa"></a></li>
						<li><a href="#">Projeto B</a> <a href="#"><img src="images/add_task.png" alt="add" title="Nova tarefa"></a></li>
						<li><a href="#">Projeto C</a> <a href="#"><img src="images/add_task.png" alt="add" title="Nova tarefa"></a></li>
					</ul>
					<a href="adc_projeto.html"><button><img src="images/add.png" alt="add"> Projeto</button></a>
				</td>
			<tr>
		</table>
	</section>

	<footer>
		<p style="text-align: center;">Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
	</footer>
</body>
</html>
