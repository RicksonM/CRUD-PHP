<?php

require_once '../../Back-end/classes/Funcoes.class.php';

require_once '../../Back-end/classes/Cliente.class.php';

$cliente = new Cliente();
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
                        <th>CPF</th>
                        <th>Estado</th>
                        <th>Tipo</th>
                    </tr>
                    <?php 
                      foreach($cliente->buscar($pesquisa) as $result){ 
                    ?>
                    <tr>
                        <td> <?php echo $result['nome'] ?></td>
                        <td> <?php echo $result['cpfcnpj'] ?></td>
                        <td> <?php echo $result['estado'] ?></td>
                        <td> <?php echo $result['tipo'] ?></td>
                    </tr>
                    
            <?php  } ?>
</table>
