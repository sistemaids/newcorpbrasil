<?PHP
// +---------------------------------------------------------+
// | Cadastro de usu�rios                                    |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id = $_POST['id'];
$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $nome . " - ";
	// Insere registro
	$sql = "INSERT INTO usuarios ";
	$sql = $sql . "(nome,login,senha,acesso) ";
	$sql = $sql . "VALUES('$nome','$login','$senha','1') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
	$titulo_pagina = "Alteração cadastral";
	$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $uf . " - " . $nome;
	// Altera registro
	$sql = "UPDATE usuarios SET ";
	$sql = $sql . "nome = '$nome', ";
	$sql = $sql . "login = '$login', ";
	$sql = $sql . "senha = '$senha' ";
	$sql = $sql . " WHERE id = '" . $id . "' ";	
	mysql_query($sql, $conexao);
}
// Exclus�o de registro
if ($acao == "exc") {
	// Insere registro
	$sql = "DELETE FROM usuarios ";
	$sql = $sql . " WHERE id = '" . $id . "' ";	
	mysql_query($sql, $conexao);
}
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_usuario_grid.php?id=" . $id . "'>";
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>


