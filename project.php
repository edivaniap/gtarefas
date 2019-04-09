<?php
//os nomes dos arquivo de tarefas terao o nome do usuario-nome do projeto

//tarefas terao a seguinte estrutura:
//{"delegateto":"",  "descption": "", "date": "", "status": ""}
//e status so recebera todo, doing e finalized

$ERROR = "";
$MESSAGE = "";
$USER_LOG = "edi"; //PEGAR ESSE DADO A PARTIR DE LOGIN
$PROJECT = "";

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
if(isset($_GET["p"])) {
    $PROJECT = $_GET["p"];

    //manipula string - troca espaco por underline e deixa minuscula
    $str_project = str_replace(" ", "_", strtolower($PROJECT));
    $str_user = strtolower($USER_LOG);

    //criando o name para o arquivo de dados do projeto
    $file_path = "js/tasks_". $str_user."-".$str_project.".json";

   echo $str_project."<br>";
   echo $str_user ."<br>";
   echo $file_path."<br>";

   if(!file_exists($file_path)) {
     fopen($file_path, "w"); //se n existe, vai criar um novo
   }

   //carrega dados atuais do json das tarefas desse projeto
   $tarefas_atuais = file_get_contents($file_path);

   //traduz os dados para $arrayName = array('' => , );
   $array_tarefas = json_decode($tarefas_atuais, true);
}

$USER_OBJ = getUser($USER_LOG);
?>
<!DOCTYPE HTML>
<html lang="pt-br">

<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>GTarefas - Projeto A</title>
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
					<center>
					<h2> <?php echo  $PROJECT?> <a href="adc_tarefa_projeto_a.html"><img src="images/add_task2.png" alt="add" title="Nova tarefa"></a></h2>
					<h2>Tarefas</h2>
            <?php
            if(isset($ERROR))
              echo $ERROR;

            if(isset($MESSAGE))
                echo $MESSAGE;
            ?>
            <!-- TABELA DE TAREFAS -->
						<table border="1" cellspacing="10" cellpadding="20">
							<tr>
								<th>A fazer</th>
								<th>Em andamento</th>
								<th>Concluído</th>
							</tr>
							<tr>
<?php
if($array_tarefas != "") {
  //$td_todo
  foreach ($array_tarefas as $tarefa) {
    if($tarefa["status"] == "todo") {
      $str = "";
      $str .= "<td>
        <p><b>Responsável:</b> ". $tarefa["delegateto"] ."</p>
        <p><b>Descrição:</b> ". $tarefa["descption"] ."</p>
        <p><b>Prazo:</b> ". $tarefa["date"] ."</p>
        <p><button>Iniciar</button></p></td>";
        echo $str;
    }
  }
} else {
  echo "<p> Não há tarefas cadastradas ainda.</p>";
}
?>
								<td>
									<p><b>Responsável:</b> Rafael</p>
									<p><b>Descrição:</b> Recarregar celular, comprar comidas, etc</p>
									<p><b>Prazo:</b> 27/02/2019</p>
									<p>
										<a href="#"><img src="images/init_task.png" alt="init" title="Iniciar tarefa"></a>
										<a href="#"><img src="images/edit_task.png" alt="edit" title="Editar tarefa"></a>
										<a href="#"><img src="images/remove_task.png" alt="remove" title="Remover tarefa"></a>
									</p>
								</td>
								<td>
									<p><b>Responsável:</b> Yuri</p>
									<p><b>Descrição:</b> Filmes etc</p>
									<p><b>Prazo:</b>04/03/2019</p>
									<p>
										<a href="#"><img src="images/finish_task.png" alt="finish" title="Finalizar tarefa"></a>
										<a href="#"><img src="images/edit_task.png" alt="edit" title="Editar tarefa"></a>
										<a href="#"><img src="images/remove_task.png" alt="remove" title="Remover tarefa"></a>
									</p>
								</td>
								<td>
									<p><b>Responsável:</b> Rafael</p>
									<p><b>Descrição:</b> Estudar os vulcoes</p>
									<p><b>Prazo:</b> 27/02/2019</p>
									<p>
										<a href="#"><img src="images/edit_task.png" alt="edit" title="Editar tarefa"></a>
										<a href="#"><img src="images/remove_task.png" alt="remove" title="Remover tarefa"></a>
									</p>
								</td>
							</tr>
							<tr>
								<td>
									<p><b>Responsável:</b>Douglas</p>
									<p><b>Descrição:</b> Desenhar personagem</p>
									<p><b>Prazo:</b> 13/04/2019</p>
									<p><button>Iniciar</button> <button>Editar</button> <button>Remover</button></p>
								</td>
								<td>
									<p><b>Responsável:</b>Vânia</p>
									<p><b>Descrição:</b> Criar gerenciador de tarefas</p>
									<p><b>Prazo:</b> 03/03/2019</p>
									<p><button>Finalizar</button> <button>Editar</button> <button>Remover</button></p>
								</td>
								<td>
								</td>
							</tr>
							<tr>
								<td>
									<p><b>Responsável:</b>Vitória</p>
									<p><b>Descrição:</b> Criar novo template</p>
									<p><b>Prazo:</b> 25/02/2019</p>
									<p><button>Iniciar</button> <button>Editar</button> <button>Remover</button></p>
								</td>
								<td>
								</td>
							</tr>
						</table>
					</center>
				</td>
			<tr>
		</table>
	</section>

	<footer>
		<p style="text-align: center;">Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
	</footer>
</body>
</html>
