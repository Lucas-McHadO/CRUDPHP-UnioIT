<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
       
    </head>
    <body>
        <?php require_once 'process.php';?>
        <div class="container">
        
        <?php if (isset($_SESSION['message'])): ?>
        
            <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
        <?php 
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        ?>    
        </div>
        <?php endif ?>
        
        <?php $mysqli = new mysqli('localhost', 'root', '123', 'produtos') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM data")  or die($mysqli->error);
        ?>
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Preço</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <?php 
                    while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['nome']; ?></td>
                    <td><?php echo $row['preco']; ?></td>
                    <td>
                        <a class="btn btn-info" href="index.php?editar=<?php echo $row['id']; ?>" >Editar</a>
                        <a class="btn btn-danger" href="process.php?delete=<?php echo $row['id'] ?>" >Deletar</a>
                        
                    </td>
                </tr>
                <?php endwhile; ?>
            </table>
        </div>
         <?php 
        function pre_r( $array) {
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }        
        ?>
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
            <label>Produto</label>
            <input type="text" name="produto"placeholder="Insira o Produto" class="form-control" value="<?php echo $nome; ?>">
            </div>
            <div class="form-group">
            <label>Preço</label>
            <input type="number" step=".01"name="preco"placeholder="Insira o Preço do Produto" class="form-control" value="<?php echo $preco; ?>" >
            </div>
            <div class="form-group">
            <?php if($update== true): ?>
            <button type="submit" class="btn btn-primary" name="update">Atualizar</button>
            <?php else: ?>
            <button type="submit" class="btn btn-primary" name="cadastrar">Cadastrar</button>
            <?php endif;?>
            </div>
            </div>
            </div>
        </form>
    </body>
</html>
