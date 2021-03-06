<?PHP
// +---------------------------------------------------------+
// | Cancelar boletos                                        |
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
$valor = $reg['valor'];
$vencimento = $reg['vencimento'];
$data = $reg['data'];

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
<form name="form_baixa" method="post" action="cancelar_boletos2.php">	
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
<td width="62%"><h1 class="c_cinza">Manutenção Cadastral <img src="../imagens/marcador_setaDir.gif" align="absmiddle" /> Usuários <img src="../imagens/marcador_setaDir.gif" align="absmiddle" /> <span class="c_preto"><?PHP print $titulo_pagina; ?></span> </h1>
</td>
<td width="38%"><div align="right">
<?PHP if($acao == "alt") { ?>
<a href="baixar_boletos.php?id=<?PHP print $id; ?>"><img src="../imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<input type="image" name="imageField" src="../imagens/btn_conf_baixa.gif" />
<input type="hidden" name="acao" value="<?PHP print $acao; ?>" />
<input type="hidden" name="id" value="<?PHP print $id; ?>" />	
<?PHP } ?>	
<?PHP if($acao == "ver") { ?>
<a href="baixar_boletos.php?id=<?PHP print $id; ?>"><img src="../imagens/btn_fechar.gif" alt="Fechar" border="0" /></a>
<?PHP } ?>
</div></td>
</tr>
</table>

<div id="caixa_cad">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="28%" class="c_preto"><h1>Nosso número</h1></td>
<td width="72%" class="c_preto"><h1><strong><?PHP print zero_esquerda($id,11); ?></strong></h1></td>
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
<td>Vencimento</td>
<td class="c_preto"><h1><strong><?PHP print substr($vencimento,8,2) . "/" . substr($vencimento,5,2) . "/" . substr($vencimento,0,4); ?></strong></h1></td>
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