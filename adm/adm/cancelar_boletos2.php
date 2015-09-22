<?PHP
// +---------------------------------------------------------+
// | cancelar boletos                                        |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];
// Campos da tabela
$id = $_POST['id'];
$status = $_POST['status'];
$data_pag = date('Y-m-d');

if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
// Altera registro
$sql = "UPDATE pedidos SET ";
$sql = $sql . "status = 'Pedido cancelado', ";
$sql = $sql . "data_pag = '$data_pag' ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_free_result($rsm);
mysql_close ($conexao);
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=baixar_boletos.php?id=" . $id . "'>";
?>

