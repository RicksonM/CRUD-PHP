<?php

//Importando as classes
require_once 'Conexao.class.php';
require_once 'Funcoes.class.php';


//Atributos do cliente
class Cliente {
    private $con;
    private $func;
    private $cpfcnpj;

    private $nome;
    private $razaoso;
    private $tipo; //fisica ou juridica

    private $pais;
    private $estado;
    private $cidade;
    private $bairro;
    private $rua;
    private $numero;
    private $cep;

    private $telefone;
    private $datacad;





//Construtor
    public function __construct(){
        $this->con = new Conexao();
        $this->func = new Funcoes();
    }

//Get e Set
     public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    public function __get($atributo){
        return $this->$atributo;
    }

//Método para realizar busca especifica
public function selecionar($dado){
    try {    //Utilizando decode no cpf
        $this->cpfcnpj = $this->func->base64($dado, 2);
        //Jogando a query SQL para a variavel select
        $select = $this->con->conectar()->prepare("SELECT cpfcnpj, nome, razaosoc, tipo, pais, estado, cidade, bairro, rua, numero, cep, telefone, data FROM Cliente where cpfcnpj = :cpfCli;");
        //Protegendo contra SQLinjection
        $select->bindParam(":cpfCli", $this->cpfcnpj, PDO::PARAM_INT);
        //Execução
        $select->execute();
        //Retorno da informação
        return $select->fetch();

    } catch (PDOExeption $ex) {
        return 'error'.$ex->getMessage();
        
    }
}


//Finalizar buscas por demais campos

public function buscar($dado){
    try{
        $result = $dado;

        $busca = $this->con->conectar()->prepare("SELECT cpfcnpj, nome, tipo, estado FROM cliente WHERE nome LIKE '%$result%'  OR  tipo LIKE '%$result%'");

        $busca->bindParam($result, $result, PDO::PARAM_INT);

        $busca->execute();

        return $busca->fetchALL();

    } catch (PDOExeption $ex){
        return 'error'.$ex->getMessage();
    }





}

//Retornando todos os dados da base
    public function selectAll(){
        try {
            $all = $this->con->conectar()->prepare("select cpfcnpj, nome, razaosoc, tipo, pais, estado, cidade, bairro, rua, numero, cep, telefone, data from Cliente");
            $all->execute();
            return $all->fetchALL();
        } catch (PDOExeption $ex) {
            return 'erro'.$ex->getMessage();
        }
    }

//Cadastrar cliente
    public function inserir($dados) {
        try{
            //Passando valores para as devidas variaveis
            $this->cpfcnpj = $dados['cpfcnpj'];

            $this->nome = $dados['nome'];
            $this->razaoso = $dados['razaoso'];
            $this->tipo = $dados['tipo'];

            $this->pais = $dados['pais'];
            $this->estado = $dados['estado'];
            $this->cidade = $dados['cidade'];
            $this->bairro = $dados['bairro'];
            $this->rua = $dados['rua'];
            $this->numero = $dados['numero'];
            $this->cep = $dados['cep'];

            $this->telefone = $dados['telefone'];
            $this->datacad = $this->func->dataAtual(1);

            $insert = $this->con->conectar()->prepare("INSERT INTO cliente (cpfcnpj, nome, razaosoc, tipo, pais, estado, cidade, bairro, rua, numero, cep, telefone, data) VALUES (:cpfcnpj, :nome, :razaoso, :tipo, :pais, :estado, :cidade, :bairro, :rua, :numero, :cep, :telefone, :datacad);");            
            $insert->bindParam(":cpfcnpj", $this->cpfcnpj, PDO::PARAM_INT);
            $insert->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $insert->bindParam(":razaoso", $this->razaoso, PDO::PARAM_STR);
            $insert->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $insert->bindParam(":pais", $this->pais, PDO::PARAM_STR);
            $insert->bindParam(":estado", $this->estado, PDO::PARAM_STR);
            $insert->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
            $insert->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
            $insert->bindParam(":rua", $this->rua, PDO::PARAM_STR);
            $insert->bindParam(":numero", $this->numero, PDO::PARAM_STR);
            $insert->bindParam(":cep", $this->cep, PDO::PARAM_STR);
            $insert->bindParam(":telefone", $this->telefone, PDO::PARAM_STR);
            $insert->bindParam(":datacad", $this->datacad, PDO::PARAM_STR);
            
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


//Editar cadastro 
    public function update($dados) {
        try{            //Adicionando o devido charset
            $this->cpfcnpj = $this->func->caracterTratar($dados['cpfcnpj'], 2);

            $this->nome = $this->func->caracterTratar($dados['nome'], 1);
            $this->razaoso = $dados['razaoso'];
            $this->pais = $dados['pais'];
            $this->estado = $dados['estado'];
            $this->cidade = $dados['cidade'];
            $this->bairro = $dados['bairro'];
            $this->rua = $dados['rua'];
            $this->numero = $dados['numero'];
            $this->cep = $dados['cep'];
            $this->telefone = $dados['telefone'];
            $this->tipo = $dados['tipo'];

            $update = $this->con->conectar()->prepare("UPDATE Cliente SET nome = :nome, razaosoc = :razaoso, tipo = :tipo,  pais = :pais, estado = :estado, cidade = :cidade, bairro = :bairro, rua = :rua, numero = :numero, cep = :cep, telefone = :telefone where cpfcnpj = :cpfCli;");
            $update->bindParam(":nome", $this->nome, PDO::PARAM_STR);
            $update->bindParam(":razaoso", $this->razaoso, PDO::PARAM_STR);
            $update->bindParam(":tipo", $this->tipo, PDO::PARAM_STR);
            $update->bindParam(":pais", $this->pais, PDO::PARAM_STR);
            $update->bindParam(":estado", $this->estado, PDO::PARAM_STR);
            $update->bindParam(":cidade", $this->cidade, PDO::PARAM_STR);
            $update->bindParam(":bairro", $this->bairro, PDO::PARAM_STR);
            $update->bindParam(":rua", $this->rua, PDO::PARAM_STR);
            $update->bindParam(":numero", $this->numero, PDO::PARAM_INT);
            $update->bindParam(":cep", $this->cep, PDO::PARAM_INT);
            $update->bindParam(":telefone", $this->telefone, PDO::PARAM_INT);
            $update->bindParam(":cpfCli", $this->cpfcnpj, PDO::PARAM_INT);
            if($update->execute()){
                return "ok";
            }else {
                return "deu ruim";
            }
        } catch (PDOExeption $ex) {
            return 'erro'.$ex->getMessage();
        }
    }
//Excluir cadastro
    public function deletar($dados){
        
        try{ 
            $this->cpfcnpj = $this->func->base64($dados, 2);
            
            $delete = $this->con->conectar()->prepare("DELETE FROM cliente WHERE cpfcnpj = :cpfCli;");
           
            $delete->bindParam(":cpfCli", $this->cpfcnpj, PDO::PARAM_INT);
            
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