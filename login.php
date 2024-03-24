<?php

    session_start();

    if(empty($_POST) or  empty($_POST["usuario"]) or empty($_POST["senha"])){
        print "<script>location.href='index.php';</script>";
    }

    include('config.php');

    $usuario = addslashes($_POST["usuario"]);
    $senha = addslashes($_POST["senha"]);

    $sql = "SELECT * FROM usuarios 
            WHERE usuario = '{$usuario}'
            AND senha = '{$senha}'";

    
    $res = $conn->query($sql) or die($conn->error);

    $row = $res->fetch_object();

   // echo "<pre>"; print_r($row); echo "</pre>"; exit;

    $qtd = $res->num_rows;

   // echo "<pre>"; print_r($qtd); echo "</pre>"; exit;


    if($qtd > 0){
        $_SESSION["usuario"] = $usuario;
        $_SESSION["nome"] =  $row->nome;
        $_SESSION["tipo"] =  $row->tipo;
        print "<script>location.href='dashboard.php';</script>";
    }else{
        print "<script>alert('Usuário e/ou senha inválidos');</script>";
        print "<script>location.href='index.php';</script>";
    }
