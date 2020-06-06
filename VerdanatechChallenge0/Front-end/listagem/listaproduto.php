<?php

require_once '../../Back-end/classes/Funcoes.class.php';
require_once '../../Back-end/classes/Produto.class.php';

require_once '../../Back-end/classes/Cliente.class.php';

$cliente = new Cliente();
$funcoes = new Funcoes();
$produto = new Produto();   

if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit':
            $pro = $produto->selecionar($_GET['pro']);
            break;
        case 'delete':
                if($produto->deletar($_GET['pro']) == 'ok'){
                    header('location: listaproduto.php');
                }else{
                    echo '<script type="text/javascript"> alert("Não estou querendo ser apagado");</script>';
                }
            break;
    }
}
if(isset($_POST['btalterar'])){


    if($produto->update($_POST) == 'ok'){

        header("location: ?acao='edit&pro=".$_GET['pro']."");

    }else{
        echo '<script type="text/javascript"> alert("Deu erro meu amigo")</script>';
    }
}


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
            <form action="buscapro.php" method="POST">
                <h4>Pesquisar</h4>
                <input type="text" name="busca" placeholder="pesquisa...">
                <input type="submit" value="buscar" name="pesq">
            </form> 

           
            <h3 class="fonts">Listar Produto</h3>

            <div id="editform">
                <form method="POST" action="">
                    <div>
                        <label>Nome</label>
                        <input type="text" name="nome" required="required" value="<?php echo $funcoes->caracterTratar((isset($pro['nome']))?($pro['nome']):(''), 2)?>"><br>
                        <input type="hidden" required="required" name="cod" value="<?php echo ((isset($pro['cod']))?($pro['cod']):('')) ?>">
                    </div>
                    <div>
                        <label>Tipo</label>
                        <input type="text" name="tipo" required="required" value="<?php echo $funcoes->caracterTratar((isset($pro['tipo']))?($pro['tipo']):(''), 2)?>"><br>
                    </div>
                    <div>
                        <label>Data de compra</label>
                        <input type="text" name="dataCompra" required="required" value="<?php echo $funcoes->caracterTratar((isset($pro['dataCompra']))?($pro['dataCompra']):(''), 2)?>"><br>
                    </div>
                    <div>
                        <label>Preço de compra</label>
                        <input type="text" name="precoCompra" required="required" value="<?php echo $funcoes->caracterTratar((isset($pro['precoCompra']))?($pro['precoCompra']):(''), 2)?>"><br>
                    </div>
                    <div>
                        <label>Preco de venda</label>
                        <input type="text" required="required" name="precoVenda" value="<?php echo ((isset($pro['precoVenda']))?($pro['precoVenda']):('')) ?>"><br>
                    </div>
                    <div>
                        <input type="submit" name="btalterar" value="Editar">
                    </div>
                </form>
            </div>

           
           
                <div id="listprod">
                <table class="striped">
                    <tr>
                        <th>Nome</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                <?php foreach($produto->selectAll() as $result){ ?>

                    <tr>
                        <td> <?php echo $result['nome'] ?></td>
                        <td><a href="?acao=edit&pro=<?php echo $funcoes->base64($result['cod'], 1)?>">editar</a></td>
                        <td><a href="?acao=delete&pro=<?php echo $funcoes->base64($result['cod'], 1)?>">deletar</a></td>
                    </tr>
                <?php  } ?>

                    <br/>
                </table>
            </div>
                   

            
            <script type="text/javascript" src="js/materialize.min.js"></script>

        </body>
    </html>