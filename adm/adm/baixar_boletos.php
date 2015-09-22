<?PHP

// +---------------------------------------------------------+
// | Baixar boletos                                          |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

$titulo_pagina = "Baixa de boletos";

// Seleciona registros
$sql = "SELECT * FROM pedidos ";
$sql = $sql . " WHERE status = 'Aguardando pagamento do boleto' ";
$sql = $sql . " ORDER BY id ASC";
$rs = mysql_query($sql, $conexao);
$total_registros = mysql_num_rows($rs);

// INSERE ZEROS � ESQUERDA DE UM N�MERO
// Par�metros: $numero = n�mero considerado, $zeros = tamanho do n�mero (com zeros)
function zero_esquerda($numero,$zeros) {	
// Retira o ponto decimal do n�mero	
$numero = str_replace(".","",$numero);
// Define o n�mero de zeros a serem inseridos � esquerda do n�mero
$loop = $zeros - strlen($numero);				
for($i=0; $i < $loop; $i++) {
$numero = "0" . $numero;
}
return $numero;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MiniERP - Administrativo</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="corpo">

<div id="topo">
  <h1>Administração do Site</h1>
</div>

<div id="caixa_menu">
	<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<h1 class="c_cinza">Contas a Receber <img src="../imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>

<P>Total de registros encontrados: <span class="c_preto"><?PHP print $total_registros; ?></span></P>
<table width="100%" cellspacing="0">
<tr>
<td width="14%" class="tabela_titulo">No do pedido</td>
<td width="16%" class="tabela_titulo">Nosso Numero</td>
<td width="33%" class="tabela_titulo">Status</td>
<td width="12%" class="tabela_titulo">Vencimento</td>
<td width="14%" align="right" class="tabela_titulo">Valor</td>
<td width="11%" class="tabela_titulo">&nbsp;</td>
</tr>
	
<!-- Exibe registros retornados pela senten�a SQL -->
<?PHP
while ($reg = mysql_fetch_array($rs)) {
$id = $reg["id"];
$num_ped = $reg["num_ped"];
$status = $reg["status"];
$vencimento = $reg["vencimento"];
$valor = $reg["valor"];
$total = $total + $valor;
?>
<tr>
<td class="registro"><?PHP print $num_ped; ?></td>
<td class="registro"><h1 class="c_verde"><strong><?PHP print zero_esquerda($id,11); ?></strong></h1></td>
<td class="registro"><?PHP print $status; ?></td>		
<td class="registro"><?PHP print substr($vencimento,8,2) . "/" . substr($vencimento,5,2) . "/" . substr($vencimento,0,4); ?></td>	
<td class="registro" align="right"><?PHP print number_format($valor,2,',','.'); ?></td>		

<!-- Verifica se o vencimento do boleto est� dentro do prazo de pagamento -->
<?PHP if($vencimento < date("Y-m-d")) { ?>
<!-- Exibe bot�o cancelar para boletos vencidos -->
<td class="registro"><div align="right"><a href="cancelar_boletos1.php?acao=alt&id=<?PHP print $id; ?>&titulo=Baixa de boletos"><img src="../imagens/btn_cancbol.gif" alt="Baixar pagamento" width="55" height="16" border="0" /></a></div></td>
<?PHP } else { ?>
<!-- Exibe bot�o baixar para baixar o boleto -->
<td class="registro"><div align="right"><a href="baixar_boletos1.php?acao=alt&id=<?PHP print $id; ?>&titulo=Baixa de boletos"><img src="../imagens/btn_baixar.gif" alt="Baixar pagamento" width="55" height="16" border="0" /></a></div></td>
<?PHP } ?>
</tr>
<?PHP } ?>	
<tr>
<td colspan="4" class="registro"><strong>Total a receber</strong></td>
<td align="right" class="registro"><strong><?PHP print number_format($total,2,',','.'); ?></strong></td>
<td class="registro">&nbsp;</td>		
</tr>
</table>
</div>
<!-- rodape da p�gina -->
<?PHP include "inc_rodape.php" ?>
</div>
</body>
</html>
<?PHP
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>