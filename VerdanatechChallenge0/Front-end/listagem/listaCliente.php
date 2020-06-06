<?php

require_once '../../Back-end/classes/Funcoes.class.php';

require_once '../../Back-end/classes/Cliente.class.php';

$cliente = new Cliente();
$funcoes = new Funcoes();





if(isset($_GET['acao'])){
    switch($_GET['acao']){
        case 'edit':
            $cli = $cliente->selecionar($_GET['cli']);
            break;
        case 'delete':
                if($cliente->deletar($_GET['cli']) == 'ok'){
                    header('location: listaCliente.php');
                }else {
                    echo '<script type="test/javascript"> alert("Erro ao deletar"); </script>';
                }
                    //header('location: listaCliente.php');               
                    //echo '<script type="text/javascript"> alert("Não estou querendo ser apagado");</script>';
            break;
    }
}

if(isset($_POST['btalterar'])){


    if($cliente->update($_POST) == 'ok'){

        header("location: ?acao='edit&cli=".$_GET['cli']."");

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

            <!--Listando clientes-->
            <!--Utilizando o metodo selectall do cliente para retornar todos os registros da tabela -->
            
            <form action="busca.php" method="POST">
                <h4>Pesquisar</h4>
                <input type="text" name="busca" placeholder="pesquisa...">
                <input type="submit" value="buscar" name="pesq">
            </form> 



            <div id="editform">
                <form method="POST" action="">
                    <div>
                        <label>Nome</label>
                        <input type="text" name="nome" required="required" value="<?php echo $funcoes->caracterTratar((isset($cli['nome']))?($cli['nome']):(''), 2) ?>"><br>
                    </div>
                    <div>
                        <label>Tipo</label>
                        <input type="text" name="tipo" required="required" value="<?php echo ((isset($cli['tipo']))?($cli['tipo']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Razao Social</label>
                        <input type="hidden" required="required" name="cpfcnpj" value="<?php echo ((isset($cli['cpfcnpj']))?($cli['cpfcnpj']):('')) ?>">
                        <input type="text" name="razaoso" required="required" value="<?php echo ((isset($cli['razaosoc']))?($cli['razaosoc']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Pais</label>
                        <input type="text" name="pais" required="required" value="<?php echo ((isset($cli['pais']))?($cli['pais']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Estado</label>
                        <input type="text" name="estado" required="required" value="<?php echo ((isset($cli['estado']))?($cli['estado']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Cidade</label>
                        <input type="text" name="cidade" required="required" value="<?php echo ((isset($cli['cidade']))?($cli['cidade']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Bairro</label>
                        <input type="text" name="bairro" required="required" value="<?php echo ((isset($cli['bairro']))?($cli['bairro']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Rua</label>
                        <input type="text" name="rua" required="required" value="<?php echo ((isset($cli['rua']))?($cli['rua']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Numero</label>
                        <input type="text" name="numero" required="required" value="<?php echo ((isset($cli['numero']))?($cli['numero']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Cep</label>
                        <input type="text" name="cep" required="required" value="<?php echo ((isset($cli['cep']))?($cli['cep']):('')) ?>"><br>
                    </div>
                    <div>
                        <label>Telefone</label>
                        <input type="text" name="telefone" required="required" value="<?php echo ((isset($cli['telefone']))?($cli['telefone']):('')) ?>"><br>
                    </div>
                    <div>
                        <input type="submit" name="btalterar" value="Editar">
                    </div>
                </form>
            </div>
            
            
                <h4>Listar cliente</h4>
                <div id="listprod">
                <table class="striped">
                    <tr>
                        <th>Nome</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                    <?php foreach($cliente->selectAll() as $result){ ?>
                    <tr>
                        <td> <?php echo $result['nome'] ?></td>
                        <td><a href="?acao=edit&cli=<?php echo $funcoes->base64($result['cpfcnpj'], 1)?>">editar</a></td>
                        <td><a href="?acao=delete&cli=<?php echo $funcoes->base64($result['cpfcnpj'], 1)?>">deletar</a></td>
                    </tr>
                    
            <?php  } ?>
                </table>
            </div>
                   

           

        </body>
    </html>