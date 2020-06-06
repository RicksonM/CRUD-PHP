<?php

require_once '../../Back-end/classes/Funcoes.class.php';
require_once '../../Back-end/classes/Produto.class.php';
require_once '../../Back-end/classes/Cliente.class.php';

//Instanciando classe produto para realizar o insert
$produto = new Produto();
$funcoes = new Funcoes();

//Se clicar no input btcadastro será acionado o método inserir do cliente pegandoas informações
//passadas via post pelo formulário 
if(isset($_POST['btcadastro'])){


    if($produto->inserir($_POST) == 'ok'){

        header('location: cadastropro.php');

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
            <link rel="stylesheet" type="text/css" href="../../Front-end/css/style.css">
            <link rel="stylesheet" type="text/css" href="../../Front-end/css/cadastrocli.css">

        </head>
        <body>
            <div>
                <ul id="menuindex">
                    <li class="itens"><a href="../../index.html">Home</a></li>
                    <li class="itens"><a href="../listagem/listaCliente.php">Listagem Cliente</a></li>
                    <li class="itens"><a href="../listagem/listaproduto.php">Listagem Produto</a></li>

                </ul>
            </div>
            <div id="CadastroCli">
                <form method="POST" action="">
                    <div class="lab">
                        <label>Nome Produto</label><br>
                        <input type="text" class="input" name="nome" required="required"><br>
                    </div>
                   
                    <div class="lab">
                        <label>Tipo</label><br>
                        <select class="select" name="tipo">
                                <option value="informatica">Informatica</option> 
                                <option value="escritorio" >Escritorio</option>
                                <option value="limpeza" selected>Limpeza</option>
                            </select>
                    </div>
                    <div class="lab">
                        <label>Data Compra</label><br>
                        <input type="date" class="input" name="dataCompra" required="required"><br>
                    </div>
                    <div class="lab">
                        <label>precoCompra</label><br>
                        <input type="number" min="1" step="any"  class="input" name="precoCompra" required="required"><br>
                    </div>
                    <div class="lab">
                        <label>PrecoVenda</label><br>
                        <input type="number" min="1" step="any"  class="input" required="required" name="precoVenda"><br>
                    </div>
                    <div class="lab">
                        <input type="submit"  class="submit" name="btcadastro" value="Cadastrar">
                    </div>
                </form>
            </div>

        </body>
    </html>