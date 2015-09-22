<?PHP
// +---------------------------------------------------------+
// | Relat�rio: Pedidos confirmados                          |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

$titulo_pagina = "Pedidos confirmados";

// Seleciona registros
$sql = "SELECT cadcli.nome, pedidos.* ";
$sql = $sql . " FROM cadcli ";
$sql = $sql . " INNER JOIN pedidos ";
$sql = $sql . " ON cadcli.id = pedidos.id_cliente ";
$sql = $sql . " WHERE pedidos.status = 'Pagamento confirmado' ";
$sql = $sql . " ORDER BY id ASC";
$rs = mysql_query($sql, $conexao);
$total_registros = mysql_num_rows($rs);
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
<h1 class="c_cinza">Relatórios <img src="../imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
<P>Total de registros confirmados: <span class="c_preto"><?PHP print $total_registros; ?></span></P>
<table width="100%" cellspacing="0">
<tr>
<td width="14%" class="tabela_titulo">No do pedido</td>
<td width="31%" class="tabela_titulo">Nome do cliente</td>
<td width="31%" class="tabela_titulo">Status</td>
<td width="13%" class="tabela_titulo">Vencimento</td>
<td width="11%" align="right" class="tabela_titulo">Valor</td>
</tr>	
<?PHP
while ($reg = mysql_fetch_array($rs)) {
$id = $reg["id"];
$id_cliente = $reg["nome"];
$num_ped = $reg["num_ped"];
$status = $reg["status"];
$vencimento = $reg["vencimento"];
$valor = $reg["valor"];
$total = $total + $valor;
?>
<tr>
<td class="registro"><?PHP print $num_ped; ?></td>
<td class="registro"><?PHP print $id_cliente; ?></td>
<td class="registro"><?PHP print $status; ?></td>		
<td class="registro"><?PHP print substr($vencimento,8,2) . "/" . substr($vencimento,5,2) . "/" . substr($vencimento,0,4); ?></td>	
<td class="registro" align="right"><?PHP print number_format($valor,2,',','.'); ?></td>		
</tr>
<?PHP } ?>	
<tr>
<td colspan="4" class="registro"><strong>Total de valores confirmados</strong></td>
<td align="right" class="registro"><strong><?PHP print number_format($total,2,',','.'); ?></strong></td>		
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