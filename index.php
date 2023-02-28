<?php

require_once("config.php");

/*$sql = new Sql();

$usuarios = $sql->select("SELECT * FROM tb_usuarios");

echo json_encode($usuarios);*/

/*$root = new Usuario();

$root->loadById(6);
echo $root;*/

//Posso chamar o metodo sem estanciar a classe porque definir o metodo como static
//$lista = Usuario::getList();
//echo json_encode($lista);

/*$busca = Usuario::search("Ca");
echo json_encode($busca);*/

/*$user = new Usuario();

$user->login("Carlos","15151");

echo ($user);*/




//$//aluno = new Usuario("Patricia","123456");

//$aluno->insert();
//echo $aluno;

$usuario = new Usuario();

$usuario->loadById(8);
$usuario->update("Professor","1231");
echo $usuario;

?>
