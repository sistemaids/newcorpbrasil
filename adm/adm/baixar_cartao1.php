<?PHP
// +---------------------------------------------------------+
// | Baixar cartao de cr�dito                                |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

$acao = $_GET['acao'];
$id = $_GET['id'];
$titulo_pagina = $_GET['titulo'];

// modo de edi��o das caixas de texto do formul�rio
$editar = "readonly='true'";
$editar_combo = "disabled='disabled'";
$estilo_caixa = "caixa_texto_des";

// Recupera registro 
$sql = "SELECT * FROM pedidos ";
$sql = $sql . " WHERE id = '" . $id . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
$id = $reg['id'];
$num_ped = $reg['num_ped'];
$cartao = $reg['cartao'];
$valor = $reg['valor'];
$vencimento = $reg['vencimento'];
$data = $reg['data'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>MiniERP - Administrativo</title>
<link href="estilo_adm.css" rel="stylesheet" type="text/css" />
</head>
<body>
<form name="form_baixa" method="post" action="baixar_boletos2.php">	
<div id="corpo">

<div id="topo">
  <h1>Administração do Site</h1>
</div>

<div id="caixa_menu">
<?PHP include "inc_menu.php" ?>
</div>

<div id="caixa_conteudo">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="62%"><h1 class="c_cinza">Contas a receber <img src="../imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "alt") { ?>
<a href="baixar_cartao.php?id=<?PHP print $id; ?>"><img src="../imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<input type="image" name="imageField" src="../imagens/btn_conf_baixa.gif" />
<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
<input type="hidden" name="id" value="<?PHP print $id; ?>" />	
<?PHP } ?>	
<?PHP if($acao == "ver") { ?>
<a href="baixar_cartao.php?id=<?PHP print $id; ?>"><img src="../imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="28%" class="c_preto"><h1>Cartão</h1></td>
<td width="72%" class="c_preto"><?PHP print $cartao; ?></td>
</tr>
<tr>
<td class="c_preto"><h1>Numero do pedido</h1></td>
<td class="c_preto"><h1><?PHP print $num_ped; ?></h1></td>
</tr>
<tr>
<td class="c_preto"><h1>Valor</h1></td>
<td class="c_preto"><h1><strong>R$ <?PHP print number_format($valor,2,',','.'); ?></strong></h1></td>
</tr>
<tr>
<td>Data do pedido</td>
<td class="c_preto"><h1><?PHP print substr($data,8,2) . "/" . substr($data,5,2) . "/" . substr($data,0,4); ?></h1></td>
</tr>
</table>
</div>
</div>
<!-- rodape da p�gina -->
<?PHP include "inc_rodape.php" ?>
</div>
</form>
</body>
</html>
<?PHP
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>