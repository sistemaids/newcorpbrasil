<?PHP
// +---------------------------------------------------------+
// | Salvar dados  cad miniaturas                            |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

// A��o a ser executada nesta p�gina (ins=inserir, alt=alterar, del=excluir, ver=visualizar
$acao = $_POST['acao'];

// Campos da tabela
$id = $_POST['id'];
$codigo = $_POST['codigo'];
$destaque = $_POST['destaque'];
$nome = $_POST['nome'];
$ano = $_POST['ano'];
$id_categoria = $_POST['id_categoria'];
$subcateg = $_POST['subcateg'];
$escala = $_POST['escala'];
$peso = $_POST['peso'];
$comprimento = $_POST['comprimento'];
$largura = $_POST['largura'];
$altura = $_POST['altura'];
$cor = $_POST['cor'];
$preco = $_POST['preco'];
$desconto = $_POST['desconto'];
$desconto_boleto = $_POST['desconto_boleto'];
$max_parcelas = $_POST['max_parcelas'];
$estoque = $_POST['estoque'];
$min_estoque = $_POST['min_estoque'];
$credito = $_POST['credito'];
$data_cad = date('Y-m-d');

// A��o de inclus�o
if ($acao == "ins") {
$titulo_pagina = "Inserir novo registro";
$mensagem = "<h1 class='c_laranja'>A inclusão do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $codigo . " - " . $nome;
// Insere registro
$sql = "INSERT INTO miniaturas ";
$sql = $sql . "(codigo,destaque,nome,ano,id_categoria,subcateg,escala,peso,comprimento,largura,altura,cor,preco,desconto,desconto_boleto,max_parcelas,estoque,min_estoque,credito,data_cad) ";
	$sql = $sql . "VALUES('$codigo','$destaque','$nome','$ano','$id_categoria','$subcateg','$escala','$peso','$comprimento','$largura','$altura','$cor','$preco','$desconto','$desconto_boleto','$max_parcelas','$estoque','$min_estoque','$credito','$data_cad') ";
	mysql_query($sql, $conexao);
}

// A��o de altera��o
if ($acao == "alt") {
$titulo_pagina = "Alteração cadastral";
$mensagem = "<h1 class='c_laranja'>A alteração do registro foi efetuada com sucesso.</h1>";
$mensagem = $mensagem . $codigo . " - " . $nome;
// Altera registro
$sql = "UPDATE miniaturas SET ";
$sql = $sql . "codigo = '$codigo', ";
$sql = $sql . "nome = '$nome', ";
$sql = $sql . "ano = '$ano', ";
$sql = $sql . "id_categoria = '$id_categoria', ";
$sql = $sql . "subcateg = '$subcateg', ";
$sql = $sql . "destaque = '$destaque', ";
$sql = $sql . "escala = '$escala', ";
$sql = $sql . "peso = '$peso', ";
$sql = $sql . "comprimento = '$comprimento', ";	
$sql = $sql . "largura = '$largura', ";
$sql = $sql . "altura = '$altura', ";
$sql = $sql . "cor = '$cor', ";
$sql = $sql . "preco = '$preco', ";
$sql = $sql . "desconto = '$desconto', ";
$sql = $sql . "desconto_boleto = '$desconto_boleto', ";
$sql = $sql . "max_parcelas = '$max_parcelas', ";
$sql = $sql . "estoque = '$estoque', ";
$sql = $sql . "min_estoque = '$min_estoque', ";
$sql = $sql . "credito = '$credito' ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}

// A��o de exclus�o
if ($acao == "exc") {
// Exclui registro
$sql = "DELETE FROM miniaturas ";
$sql = $sql . " WHERE id = '" . $id . "' ";	
mysql_query($sql, $conexao);
}
// Executa p�gina cad_miniaturas_grid.php
print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=cad_miniaturas_grid.php?id=" . $id . "'>";	
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>

