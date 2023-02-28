<?php

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

//$root = new Usuario();

/*$root->loadById(6);*/

//Posso chamar o metodo sem estanciar a classe porque definir o metodo como static
//$lista = Usuario::getList();
//echo json_encode($lista);

/*$busca = Usuario::search("Ca");
echo json_encode($busca);*/

$user = new Usuario();

$user->login("CarloWs","15151");

echo ($user);


?>
