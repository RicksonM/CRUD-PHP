<?php

require_once '../../Back-end/classes/Funcoes.class.php';

require_once '../../Back-end/classes/Produto.class.php';

$produto = new Produto();
$funcoes = new Funcoes();


$pesquisa = $_POST['busca'];

?>

<!DOCTYPE html>
    <html>
        <head>
            <title></title>
            <meta charset="utf-8" lang="pt-br">
            <link rel="stylesheet" type="text/css" href="../css/style.css">
            <link rel="stylesheet" type="text/css" href="../css/lista.css">
            <link type="text/css" rel="stylesheet" href="../css/materialize/css/materialize.min.css"  media="screen,projection"/>

        <!--Menu-->
        </head>
        <body>
            <div>
                <ul id="menuindex">
                    <li class="itens"><a href="../../index.html">Home</a></li>
                    <li class="itens"><a href="../listagem/listaCliente.php">Listagem Cliente</a></li>
                    <li class="itens"><a href="../listagem/listaproduto.php">Listagem Produto</a></li>


                    
                </ul>
            </div>

            <!--Listando clientes-->
            <h1>Listar cliente</h1>


<table class="striped">
                    <tr>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Preço</th>
                        <th>Data</th>
                    </tr>
                    <?php 
                      foreach($produto->buscar($pesquisa) as $result){ 
                    ?>
                    <tr>
                        <td> <?php echo $result['nome'] ?></td>
                        <td> <?php echo $result['tipo'] ?></td>
                        <td> <?php echo $result['precoCompra'] ?></td>
                        <td> <?php echo $result['dataCompra'] ?></td>
                    </tr>
                    
            <?php  } ?>
</table>
