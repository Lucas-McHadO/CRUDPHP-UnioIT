<?php
session_start();
$mysqli = new mysqli('localhost', 'root' , '123', 'produtos') or die ($mysqli->error($mysqli));

$id =0;
$update = false;
$nome = '';
$preco = '';

if (isset($_POST['cadastrar'])){
    $nome = $_POST ['produto'];
    $preco = $_POST ['preco'];
    
    $mysqli->query("INSERT INTO data (nome , preco) VALUES('$nome', '$preco')") or die($mysqli->error);
    
    $_SESSION['message'] = "Registro foi Salvo";
    $_SESSION['msg_type'] = "success";
    
    header('location: index.php');
}
if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());
   
    $_SESSION['message'] = "Registro foi Deletado";
    $_SESSION['msg_type'] = "danger";
    
    header('location: index.php');
    
}
if (isset($_GET['editar'])){
    $id = $_GET['editar'];
    $update = true;
     $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
     
     $row = $result->fetch_array();
     $nome = $row['nome'];
     $preco = $row['preco']; 
}

if (isset($_POST['update'])){
    $id = $_POST['id'];
    $nome = $_POST['produto'];  
    $preco = $_POST['preco'];
    
    
     $mysqli->query("UPDATE data SET nome='$nome', preco='$preco' WHERE id=$id") or die($mysqli->error);
    
     $_SESSION['message'] = "Registro foi atualizado";
     $_SESSION['msg_type'] = "warning";
     
    header('location: index.php');
}
