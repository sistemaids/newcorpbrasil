<?PHP
// +---------------------------------------------------------+
// | Recupera dados da p�gina index.php                      |
// +---------------------------------------------------------+

include "../inc_dbConexao.php";

SESSION_START();

// Captura dados enviados pelo m�todo POST da p�gina index.php
$login = $_POST['login'];
$senha = $_POST['senha'];

// Verifica se o e-mail do cliente j� est� cadastrado
$sql = "SELECT * ";
$sql = $sql . " FROM usuarios ";
$sql = $sql . " WHERE login = '" . $login . "' ";
$sql = $sql . " AND senha = '" . $senha . "' ";
$rs = mysql_query($sql, $conexao);
$reg = mysql_fetch_array($rs);
// Recupera o n�mero de acesso do usu�rio
$id = $reg['id'];
$acesso = $reg['acesso'];
$total_registros = mysql_num_rows($rs);
if ($total_registros == 0) {
	$_SESSION['mensagem_erro'] = "Login ou senha inválidos";
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=index.php'>";
} else {
	$_SESSION['mensagem_erro'] = "";
	// Autoriza libera��o para as p�ginas de administra��o do site
	$_SESSION['acesso'] = "fs_liberado";	
	// Executa a p�gina entrada.php
	print "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=entrada.php'>";	
}
// Libera os recursos usados pela conex�o atual
mysql_free_result($rs);
mysql_close ($conexao);
?>