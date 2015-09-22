<?PHP
// +---------------------------------------------------------+
// | Baixar cartao de cr�dito                                |
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
$sql = $sql . "status = 'Pagamento confirmado', ";
$sql = $sql . "data_pag = '$data_pag' ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);

// Baixa do estoque
// Recupera n�mero do pedido 
$sql = "SELECT * FROM pedidos ";
$sql = $sql . " WHERE id = '" . $id . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$num_ped = $reg['num_ped'];


// Verifica os itens do pedido
$sqli = "SELECT * FROM itens";
$sqli = $sqli . " WHERE num_ped = '" . $num_ped . "' ";
$rsi = mysql_query($sqli, $conexao);
$total_registros = mysql_num_rows($rsi);
// Captura os itens do pedido
while ($regi = mysql_fetch_array($rsi)) {
$codigo = $regi["codigo"];
$qt = $regi["qt"];

// Recupera quantidade em estoque do item
$sqlm = "SELECT * FROM miniaturas";
$sqlm = $sqlm . " WHERE codigo = '" . $codigo . "' ";	
$rsm = mysql_query($sqlm, $conexao);
$regm = mysql_fetch_array($rsm);
$qt_estoque = $regm['estoque'];

// Armazena na vari�vel qt_estoque_atual a quantidade em estoque menos a quantidade vendida
$qt_estoque_atual = $qt_estoque - $qt;

// Baixa o item do estoque
$sqlu = "UPDATE miniaturas SET ";
$sqlu = $sqlu . "estoque = '$qt_estoque_atual' ";
$sqlu = $sqlu . " WHERE codigo = '" . $codigo . "' ";	
mysql_query($sqlu, $conexao);
} 
}
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_free_result($rsm);
mysql_close ($conexao);
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=baixar_boletos.php?id=" . $id . "'>";
?>

