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
            $str_todo = "";
            $str_doing = "";
            $str_finalized = "";

            if($array_tarefas != "") {
              foreach ($array_tarefas as $tarefa) {
                if($tarefa["status"] == "todo") {
                  $str_todo .= "<td>
                              <p><b>Responsável:</b> ". $tarefa["delegateto"] ."</p>
                              <p><b>Descrição:</b> ". $tarefa["descption"] ."</p>
                              <p><b>Prazo:</b> ". $tarefa["date"] ."</p>
                              <p><button>Iniciar</button></p>
                            </td>";
                } else if($tarefa["status"] == "doing") {
                  $str_doing .= "<td>
                              <p><b>Responsável:</b> ". $tarefa["delegateto"] ."</p>
                              <p><b>Descrição:</b> ". $tarefa["descption"] ."</p>
                              <p><b>Prazo:</b> ". $tarefa["date"] ."</p>
                              <p><button>Finalizar</button></p>
                            </td>";
                } else if($tarefa["status"] == "finalized") {
                  $str_finalized .= "<td>
                              <p><b>Responsável:</b> ". $tarefa["delegateto"] ."</p>
                              <p><b>Descrição:</b> ". $tarefa["descption"] ."</p>
                              <p><b>Prazo:</b> ". $tarefa["date"] ."</p>
                              <p><button>Reabrir</button></p>
                            </td>";
                } else {
                    $ERROR = "<p style='color: crimson'> Erro: Há tarefas sem status definido.</p>";
                }
              }
            } else {
              $MESSAGE = "<p> Informção: Não há tarefas cadastradas ainda.</p>";
            }
            ?>
            <?php
            if(isset($ERROR))
              echo $ERROR;

            if(isset($MESSAGE))
                echo $MESSAGE;
            ?>
            <!-- TABELA DE TAREFAS -->
						<table border="1" cellspacing="10" cellpadding="20">
              <!-- coluna de tarefas a fazer -->
              <tr>
                  <th style="background-color: Tomato;">A fazer</th>
                  <?php echo $str_todo ?>
							</tr>

              <!-- coluna em andamento -->
							<tr>
                <th style="background-color: GreenYellow;">Em andamento</th>
                <?php echo $str_doing ?>
							</tr>

              <!-- coluna de tarefas finaizadas -->
							<tr>
                <th style="background-color: MediumSpringGreen;">Concluído</th>
                <?php echo $str_finalized ?>
							</tr>
						</table>
					</center>
				</td>
			<tr>
		</table>
    <center>
    <a href="home.php"><button>Voltar</button></a>
    </center>
	</section>

	<footer>
		<p style="text-align: center;">Desenvolvimento Web I @ 2019.1 - Pontes ©</p>
	</footer>
</body>
</html>
