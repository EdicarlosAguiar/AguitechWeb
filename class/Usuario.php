<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Usuario
{

    private $idusuario;
    private $deslogin;
    private $dessenha;
    private $dtcadastro;




    /**
     * Get the value of deslogin
     */
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

            $this->setIdusuario($row['idusuario']);
            $this->setDeslogin($row['deslogin']);
            $this->setDessenha($row['dessenha']);
            $this->setDtcadastro(new DateTime($row['dtcadastro']));
        }
    }

    public function __toString()
    {
        return json_encode(array(
            "idusuario" => $this->getIdusuario(),
            "deslogin" => $this->getDeslogin(),
            "dessenha" => $this->getDessenha(),
            "dtcadastro" => $this->getDtcadastro()->format("d/m/y h:i:s")
        ));
    }
}
