<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Usuario
{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;

    public function getDeslogin()
    {
        return $this->deslogin;
    }


    public function setDeslogin($deslogin)
    {
        $this->deslogin = $deslogin;

        return $this;
    }


    public function getDessenha()
    {
        return $this->dessenha;
    }


    public function setDessenha($dessenha)
    {
        $this->dessenha = $dessenha;

        return $this;
    }


    public function getDtcadastro()
    {
        return $this->dtcadastro;
    }


    public function setDtcadastro($dtcadastro)
    {
        $this->dtcadastro = $dtcadastro;

        return $this;
    }


    public function getIdusuario()
    {
        return $this->idusuario;
    }


    public function setIdusuario($idusuario)
    {
        $this->idusuario = $idusuario;

        return $this;
    }


    public function loadById($id)
    {

        $sql = new Sql();

        $result = $sql->select("select * from tb_usuarios where idusuario = :ID", array(
            ":ID" => $id
        ));
        if (count($result) > 0) {

            $row = $result[0];

            $this->setData($result[0]);
        }
    }

  

    public function update($login, $password){

        $this->setDeslogin($login);
        $this->setDessenha($password);

        $sql = new Sql();

        $sql->select("UPDATE tb_usuarios SET deslogin = :LOGIN, dessenha = :PASSWORD WHERE idusuario = :ID", array(

            ':LOGIN'=>$this->getDeslogin(),
            ':PASSWORD'=>$this->getDessenha(),
            ':ID'=>$this->getIdusuario()

        ));

    }

    //="" evitar que seja obrigatorio a passagem dos parametros quando classe for instanciada
    public function __construct($login = "", $password = "")
    {
        $this->setDeslogin($login);
        $this->setDessenha($password);
    }


    public function __toString()
    {
        return json_encode(array(
            "idusuario" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d/m/Y | h:i:s")
        ));
    }


    public static function getList()
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");
    }

    public static function search($login)
    {
        $sql = new Sql();

        return $sql->select("SELECT * FROM tb_usuarios where deslogin LIKE :A ORDER BY deslogin", array(

            ':A' => "%" . $login . "%"


        ));
    }

    public function login($login, $senha)
    {
        $sql = new Sql();

        $result = $sql->select(
            "select * from tb_usuarios where deslogin = :LOGIN AND dessenha = :SENHA",
            array(
                ":LOGIN" => $login, ":SENHA" => $senha
            )
        );
        if (count($result) > 0) {

            $this->setData($result[0]);
        } else {
            throw new Exception("Login e/ou senha inválidos!");
        }
    }

    public function setData($data)

    {

        $this->setIdusuario($data['idusuario']);
        $this->setDeslogin($data['deslogin']);
        $this->setDessenha($data['dessenha']);
        $this->setDtcadastro(new DateTime($data['dtcadastro']));
    }

    public function insert()
    {
        $sql = new Sql();

        $results = $sql->select("CALL sp_usuarios_insert(:LOGIN,:PASSWORD)", array(

            ':LOGIN' => $this->getDeslogin(), ':PASSWORD' => $this->getDessenha()
        ));
        if (count($results) > 0) {
            $this->setData($results[0]);
        }
    }
}
