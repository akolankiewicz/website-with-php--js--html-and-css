<?php  
session_start();
include_once('config.php');

if((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true ))
{

    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('Location: tela-de-login.php');
}
$logado = $_SESSION['email'];
if(!empty($_GET['search'])){
  $data = $_GET['search'];
  $sql = "SELECT * FROM usuarios WHERE id LIKE '%$data%' OR email LIKE '%$data%' ORDER BY id DESC";
}
else{
$sql = "SELECT * FROM usuarios ORDER BY id DESC";
}


$result = $conexao->query($sql);

 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
body {
        background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(19, 75, 130));
        color: white;
        text-align: center;
    }

    nav{
        background-image: linear-gradient(to left, rgb(20, 147, 220), rgb(40, 177, 270));
        color: white;
    }
    a{
        color: white; 
        text-align: right;
        position: center;
    }

    .table-bg{

        background: rgba(0,0,0,0.3);
        border-radius: 15px 15px 0 0;
    }
    .box-search{
      display: flex;
      justify-content: center;
      gap: .1%;
    }
        </style>
</head>
<body>
<!--  nav -->  
<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        
      <h2> SISTEMA </h2>
        
      <button type="button" class="btn btn-danger"> <a class="nav-link" href="sair.php">SAIR</a> </button>
       
      </div>
    </div>
  </div>
</nav>
<br>
    <?php 
    echo "<h1>Bem-vindo <u>$logado</u><h1>";
    ?>
   <br>
      <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class="btn btn-primary">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
        </button>
      </div>
    

    <div class="m-5">
    <table class="table text-white table-bg">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Senha</th>
      <th scope="col">Email</th>
      <th scope="col">Telefone</th>
      <th scope="col">Sexo</th>
      <th scope="col">Data de nascimento</th>
      <th scope="col">Cidade</th>
      <th scope="col">Estado</th>
      <th scope="col">Endereço</th>
      <th scope="col">...</th>
    </tr>
  </thead>
  <tbody>
    <?php
    
    while($user_data = mysqli_fetch_assoc($result))
    {
        echo "<tr>";
        echo "<td>".$user_data['id']."</td>";
        echo "<td>".$user_data['nome']."</td>";
        echo "<td>".$user_data['senha']."</td>";
        echo "<td>".$user_data['email']."</td>";
        echo "<td>".$user_data['telefone']."</td>";
        echo "<td>".$user_data['sexo']."</td>";
        echo "<td>".$user_data['data_nasc']."</td>";
        echo "<td>".$user_data['cidade']."</td>";
        echo "<td>".$user_data['estado']."</td>";
        echo "<td>".$user_data['endereco']."</td>";
        echo "<td>
        <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
        <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325'/>
        </svg>
        </a>
        <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>
        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
        <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0'/>
      </svg>
        </a>
        </td>";
        echo "</tr>";
    }
    ?>
   
  </tbody>
</table>

    </div>
</body>
<script>
  var search = document.getElementById("pesquisar");

  search.addEvenListener("keydown", function(event) {
    if (event.key === "Enter"){
      searchData();
    }
  })

  function searchData()
  {
    window.location = "sistema.php?search="+search.value;
  }
</script>
</html>