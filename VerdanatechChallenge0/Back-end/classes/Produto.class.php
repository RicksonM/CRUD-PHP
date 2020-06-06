<?php

require_once 'Conexao.class.php';

require_once 'Funcoes.class.php';

class Produto{
    
    private $func;
    private $con;
    private $cod;
    private $nome;
    private $tipo;
    private $precoCompra;
    private $precoVenda;
    private $dataCompra;

    public function __construct(){
        $this->con = new Conexao();
        $this->func = new Funcoes();
       
    }

    public function __set($atributo, $valor){
        $this->$atributo = $this->$valor;
    }

    public function __get($atributo){
        return $this->$atributo;
    }
    



    //Cadastrar
    // Método para realizar o cadastro do produto na base de dados através do insert

      public function inserir($dados) {
        try{
            //Passando valores para as devidas variaveis
           
            $this->nome = $dados['nome'];
            $this->dataCompra = $dados['dataCompra'];
            $this->tipo = $dados['tipo'];
            $this->precoCompra = $dados['precoCompra'];
            $this->precoVenda = $dados['precoVenda'];

            $insert = $this->con->conectar()->prepare("INSERT INTO produto ( nome, dataCompra, tipo, precoCompra, precoVenda) VALUES ( :nome, :dataCompra, :tipo, :precoCompra, :precoVenda);");            
            $insert->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $insert->bindParam(":dataCompra", $this->dataCompra, PDO::PARAM_STR);
            $insert->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $insert->bindParam(":precoCompra", $this->precoCompra, PDO::PARAM_INT);
            $insert->bindParam(":precoVenda", $this->precoVenda, PDO::PARAM_INT);
           


            var_dump($insert);
            if($insert->execute()){
                return 'ok';
            } else {
                return 'erro';
            }


        } catch (PDOExeption $ex){
            return 'erro'.$ex->getMessage();
        }
    }


 //   Realiza busca personalizada na tabela produto 
    public function buscar($dado){
        try{
            $result = $dado;
    
            $busca = $this->con->conectar()->prepare("SELECT cod, nome, tipo, precoCompra, dataCompra FROM produto WHERE nome LIKE '%$result%'");
    
            $busca->bindParam($result, $result, PDO::PARAM_INT);
    
            $busca->execute();
    
            return $busca->fetchALL();
    
        } catch (PDOExeption $ex){
            return 'error'.$ex->getMessage();
        }
    
    }




//Seleciona determinado dado
    public function selecionar($dado){
        try {    //Utilizando decode no cpf
            $this->cod = $this->func->base64($dado, 2);
            //Jogando a query SQL para a variavel select
            $select = $this->con->conectar()->prepare("SELECT cod, nome, dataCompra, tipo, precoCompra, precoVenda FROM produto where cod = :cod;");
            //Protegendo contra SQLinjection
            $select->bindParam(":cod", $this->cod, PDO::PARAM_INT);
            //Execução
            $select->execute();
            //Retorno da informação
            return $select->fetch();
    
        } catch (PDOExeption $ex) {
            return 'error'.$ex->getMessage();
            
        }
    }

    //Trás todos os registros
    public function selectAll(){
        try {
            $all = $this->con->conectar()->prepare("select * from Produto");
            $all->execute();
            return $all->fetchALL();
        } catch (PDOExeption $ex) {
            return 'erro'.$ex->getMessage();
        }
    }

    //Atualização de dados
    public function update($dados) {
        try{            //Adicionando o devido charset
            $this->cod = $this->func->caracterTratar($dados['cod'], 2);
            $this->nome = $this->func->caracterTratar($dados['nome'], 1);
            $this->tipo =  $this->func->caracterTratar($dados['tipo'], 1);
            $this->dataCompra = $dados['dataCompra'];
            $this->precoCompra = $dados['precoCompra'];
            $this->precoVenda = $dados['precoVenda'];
                                                                  
            $update = $this->con->conectar()->prepare("UPDATE produto SET nome = :nome, tipo = :tipo, dataCompra = :dataCompra,  precoCompra = :precoCompra, precoVenda = :precoVenda WHERE cod = :cod;");
            $update->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $update->bindParam(":precoCompra", $this->precoCompra, PDO::PARAM_INT);
            $update->bindParam(":precoVenda", $this->precoVenda, PDO::PARAM_INT);
            $update->bindParam(":dataCompra", $this->dataCompra, PDO::PARAM_STR);
            $update->bindParam(":cod", $this->cod, PDO::PARAM_INT);
            $update->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            
            if($update->execute()){
                return "ok";
            }else {
                return "deu ruim";
            }
        } catch (PDOExeption $ex) {
            return 'erro'.$ex->getMessage();
        }
    }

    public function deletar($dados){
        try{ 
            $this->cod = $this->func->base64($dados, 2);

            $delete = $this->con->conectar()->prepare("DELETE FROM produto WHERE cod = :cod");
            $delete->bindParam(":cod", $this->cod, PDO::PARAM_INT);
            
            if($delete->execute()){
                return 'ok';
            } else {
                return 'deu ruim';
            }
        }catch(PDOExeption $ex) {
            return 'erro'.$ex->getMessage();
        }
    }

}



?>