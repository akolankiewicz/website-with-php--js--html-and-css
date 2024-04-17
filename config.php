<?php
    $dbHost = 'LocalHost';
    $dbUsername  = 'root';
    $dbPassword = '';
    $dbName = 'formulário-arthur';

    $conexao = new mysqli($dbHost,$dbUsername,$dbPassword,$dbName);

    if($conexao->connect_errno)
    {
        echo "erro";
    }
    else
    {
       //echo "conexão efetuada com sucesso";
    }
?>