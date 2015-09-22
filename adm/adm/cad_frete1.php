<?PHP
// +---------------------------------------------------------+
// | Salvar dados  do frete                                  |
// +---------------------------------------------------------+
// | Parte integrante do livro da série Faça um Site         |
// | PHP 5 com banco de dados MySQL - Comércio eletrônico    |
// | Editora Érica - autor: Carlos A J Oliviero              |
// | www.facaumsite.com.br                                   |
// +---------------------------------------------------------+
include "../inc_dbConexao.php";
SESSION_START();
// Ação a ser executada nesta página (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id = $_POST['id'];
$uf = $_POST['uf'];
$nome = $_POST['nome'];
$frete = $_POST['frete'];
$cepi = $_POST['cepi'];
$cepf = $_POST['cepf'];
// Ação de inclusão
if ($acao == "ins") {
	$titulo_pagina = "Inserir novo registro";
	$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
	$mensagem = $mensagem . $uf . " - " . $nome;
	// Insere registro
	$sql = "INSERT INTO tb_estados ";
	$sql = $sql . "(uf,nome,frete,cepi,cepf) ";
	$sql = $sql . "VALUES('$uf','$nome','$frete','$cepi','$cepf') ";
	mysql_query($sql, $conexao);
}
// Ação de alteração
if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
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

// Ação de exclusão
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM tb_estados ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}
// Executa página cad_miniaturas_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_frete_grid.php?id=" . $id . "'>";
// Libera os recursos usados pela conexão atual
mysql_free_result($rs);
mysql_close ($conexao);
?>
