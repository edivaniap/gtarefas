/*$(document).ready(function() {
	$('#login').click(function() {
		var user = $('#username').val();
		var pass = $('#password').val();

		var erro = true;

		$("#loading").html("<img src'../images/laoder.gif'/>").fadeIn('fast');

		$.ajax({
			type: "POST",
			url: "users.json",
			dataType: "json",
			success: function(data) {
				$
			}
		});
	});
});
*/

function ajaxRequest() {
    var userRequest = new XMLHttpRequest();
    userRequest.open('GET', 'users.json')
    userRequest.onload = function() {
        if (userRequest.status >= 200 && userRequest.status < 400) {
            var userList = JSON.parse(userRequest.responseText);
            renderHTML(taskList);
        } else {
            console.log("Servidor ativo, mas ocorreu um erro!");
        }
    };
    taskRequest.onerror = function() {
        console.log("Erro de conexão");
    }
    taskRequest.send();  
}


function ajaxAddUser() {
    console.log("entrando add user...");

    var pass = document.getElementById("pass").value,
        confpass = document.getElementById("confpass").value;

    if (pass == confpass) {
    	var user = document.getElementById("username").value,
    		name = document.getElementById("name").value,
    		bio = document.getElementById("bio").value;

    	toAdd = {"name": name , "bio": bio, "username": user, "password": pass}; 
    } else {
    	alert("A confrimação da senha não confere.");
    }

/*        taskListObj = JSON.parse(tasks),
        toAdd = {"tarefa":novaTarefa , "responsavel":novoResponsavel}; 
    taskListObj.push(toAdd);
    //grava nova lista de tarefas com Ajax
    var taskRequest = new XMLHttpRequest();
    taskRequest.open('POST', 'tarefas-json.php',true);
    taskRequest.onload = function() {
        if (taskRequest.status >= 200 && taskRequest.status < 400) {
            console.log("Sucesso em ajaxAddRequest\n" + taskRequest.responseText);
            renderHTML(taskListObj);
        } else {
            console.log("Servidor ativo, mas ocorreu um erro!");
        }
    };
    taskRequest.onerror = function() {
        console.log("Erro de conexão");
    }
    taskRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var taskListJson = JSON.stringify(taskListObj),
        queryString = "tarefas=" + taskListJson;
    localStorage.setItem('taskList',taskListJson);
    taskRequest.send(queryString);  */
}