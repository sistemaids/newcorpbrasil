<?PHP
// +---------------------------------------------------------+
// | Salvar dados  do frete                                  |
// +---------------------------------------------------------+
// | Parte integrante do livro da s�rie Fa�a um Site         |
// | PHP 5 com banco de dados MySQL - Com�rcio eletr�nico    |
// | Editora �rica - autor: Carlos A J Oliviero              |
// | www.facaumsite.com.br                                   |
// +---------------------------------------------------------+
include "../inc_dbConexao.php";
SESSION_START();
// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id = $_POST['id'];
$uf = $_POST['uf'];
$nome = $_POST['nome'];
$frete = $_POST['frete'];
$cepi = $_POST['cepi'];
$cepf = $_POST['cepf'];
// A��o de inclus�o
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclus�o do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $uf . " - " . $nome;
	// Insere registro
	$sql = "INSERT INTO tb_estados ";
	$sql = $sql . "(uf,nome,frete,cepi,cepf) ";
	$sql = $sql . "VALUES('$uf','$nome','$frete','$cepi','$cepf') ";
	mysql_query($sql, $conexao);
}
// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Altera��o cadastral";
$mensagem = "<h1 class='c_laranja'>A altera��o do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $uf . " - " . $nome;
// Altera registro
$sql = "UPDATE tb_estados SET ";
$sql = $sql . "uf = '$uf', ";
$sql = $sql . "nome = '$nome', ";
$sql = $sql . "frete = '$frete', ";
$sql = $sql . "cepi = '$cepi', ";
$sql = $sql . "cepf = '$cepf' ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM tb_estados ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_miniaturas_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_frete_grid.php?id=" . $id . "'>";
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>
