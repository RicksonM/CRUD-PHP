<?php

require_once '../../Back-end/classes/Funcoes.class.php';

require_once '../../Back-end/classes/Cliente.class.php';

$cliente = new Cliente();
$funcoes = new Funcoes();

if(isset($_POST['btcadastro'])){


    if($cliente->inserir($_POST) == 'ok'){
        echo '<script type="text/javascript"> alert("Inserido com sucesso")</script>';
        header('location: cadastrocli.php');

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
            <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
           
           

        </head>
        <body>
            <div>
                <ul id="menuindex">
                    <li class="itens"><a href="../../index.html">Home</a></li>
                    <li class="itens"><a href="../listagem/listaCliente.php">Listagem Cliente</a></li>
                    <li class="itens"><a href="../listagem/listaproduto.php">Listagem Produto</a></li> 
                </ul>
            </div>

            <div id="sob">
                <div id="CadastroCli">
                    <form method="POST" action="">
                        <div class="lab">
                            <label>Nome</label><br>
                            <input class="input" type="text" name="nome" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>razao</label><br>
                            <input class="input" type="text" name="razaoso" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>tipo</label><br>
                            <select  name="tipo">
                                <option value="fisica">Pessoa fisica</option> 
                                <option value="juridica" selected>Pessoa juridica</option>
                            </select>
                        </div> 

                        <div class="lab">
                            <label>CPF / CNPJ</label><br>
                            <input id="cpfcnpj"   class="input" type="number" required="required" placeholder=""  name="cpfcnpj"><br>
                        </div>
                      
                        <div class="lab">
                            <label>Pais</label><br>
                            <input class="input" type="text" name="pais" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>Estado</label><br>
                            <input class="input" type="text" name="estado" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>cidade</label><br>
                            <input class="input" type="text" name="cidade" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>bairro</label><br>
                            <input class="input" type="text" name="bairro" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>rua</label><br>
                            <input class="input" type="text" name="rua" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>numero</label><br>
                            <input class="input" type="number" name="numero" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>cep</label><br>
                            <input class="input" type="number" name="cep" placeholder="" required="required"><br>
                        </div>
                        <div class="lab">
                            <label>Telefone</label><br>
                            <input class="input" type="number" name="telefone" placeholder=""  required="required"><br>
                        </div>
                        <div >
                            <input  type="submit" id="botao" name="btcadastro" value="Cadastrar">
                        </div>
                    </form>
                </div>
            </div>
            




            <script type="text/javascript" src="../js/mascaras.js"></script>


      
            

           
      
        </body>
    </html>