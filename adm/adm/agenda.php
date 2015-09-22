
// +---------------------------------------------------------+
// | Agenda                                                  |
// +---------------------------------------------------------+

<?php

$eventos = array(
	'06/2013' => array(
		array('dia'=>'16','descricao'=>'Evento legal 1'),
		array('dia'=>'17','descricao'=>'Evento legal 2'),
		array('dia'=>'18','descricao'=>'Evento legal 3'),
		array('dia'=>'20','descricao'=>'Evento legal 4'),
		array('dia'=>'06','descricao'=>'Evento legal 5'),
		array('dia'=>'06','descricao'=>'Evento legal 5'),
	)
);

$meses = explode(',','janeiro,fevereiro,março,abril,maio,junho,julho,agosto,setembro,outubro,novembro,dezembro');
$diasSemana = explode(',','dom,seg,ter,qua,qui,sex,sáb');

$mes = empty($_GET['mes']) ? date('m') : max(min($_GET['mes'],12), 1);
$ano = empty($_GET['ano']) ? date('Y') : max(min($_GET['ano'],2050), 2010);


?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="css/main.css">
		
        <style>
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
			
			.mes-anterior, .mes-seguinte  {
				background-image: URL("img/strip-gray.png");
				color: #CCCCCC;
			}
			.com-eventos {
				background-image: URL("img/strip-green.png");
				font-weight:bold;
				cursor: pointer;
			}
			.com-eventos .dropdown > a{
				color: #FFFFFF;
			}
			.align-center {
				text-align: center !important;
			}
			
			.table td {
				position: relative;
			}
			
			.table td .badge {
				position: absolute;
				right: 0px;
				bottom: 0px;
			}
			
			form {
				width: 550px;
				margin-left: auto;
				margin-right: auto;
			}
        </style>

        <script src="js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    </head>
    <body>
        <form>
			<table class="table table-bordered table-striped">
				<?php
				$date = new DateTime();
				$date->setDate($ano,$mes,1);
				
				$dateAux = clone $date;
				
				$diaSemana = $date->format('w');
				$diasMes = $date->format('t');
				
				$dateAux->setDate($ano, $mes-1, 1);
				$queryStringAnterior = sprintf('?mes=%02d&ano=%d', $dateAux->format('m'), $dateAux->format('Y'));
				
				$dateAux->setDate($ano, $mes+1, 1);
				$queryStringProximo = sprintf('?mes=%02d&ano=%d', $dateAux->format('m'), $dateAux->format('Y'));
				
				$dateAux->setDate($ano, $mes, 1);
				
				$lista = !empty($eventos[$date->format('m/Y')]) ? $eventos[$date->format('m/Y')] : array();
				
				echo '<tr>';
				echo '<th class="align-center"><a href="', $queryStringAnterior, '"> Anterior</a> </th>';
				echo '<th class="align-center" colspan="5">', ucfirst($meses[$mes-1]), ' / ', $ano,'</th>';
				echo '<th class="align-center"><a href="', $queryStringProximo, '"> Próximo</a> </th>';
				echo '</tr>';
				
				echo '<tr>';
				for($i=0; $i<7; $i++){
					echo '<th width="14%">', $diasSemana[$i],'</th>';
				}
				echo '</tr>';
				
				echo '<tr>';
				if($diaSemana > 0){
					$dateAux->modify('-'.($diaSemana+1).' day');
					while($diaSemana > 0){
						$dateAux->modify('+1 day');
						echo '<td class="vazio mes-anterior">',$dateAux->format('d'),'</td>';
						$diaSemana--;
					}
				}
				
				for($i=1; $i<=$diasMes; $i++){
					$eventosDia = array();
					$date->setDate($ano,$mes,$i);
					$diaSemana = $date->format('w');
					
					foreach($lista as $item){
						if($item['dia'] == $i){
							$eventosDia[] = $item;
						}
					}
					
					$class = '';
					if($diaSemana % 6 == 0){
						$class = 'fim-semana';
					}
					
					$htmlData = $date->format('d');
					if(!empty($eventosDia)){
						$class .= ' com-eventos';
						$htmlData = '<div class="dropdown">
							<a href="#" data-toggle="dropdown">'.$date->format('d').'</a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">';
						foreach($eventosDia as $evento){
							$htmlData .= '<li><a href="#">' . $evento['descricao'] . '</a></li>';
						}
						$htmlData .= '</ul></div>';
					}
					
					printf( '<td class="%s" data-toggle="dropdown"> %s <span class="badge badge-warning">%s</span></td>',
						$class,
						$htmlData,
						empty($eventosDia) ? '': count($eventosDia)
					);
					
					if($diaSemana == 6){
						echo '</tr>';
						if($i < $diasMes){
							echo '<tr>';
						}
					}
				}
				
				if($diaSemana < 6){
					$date->modify('+'.($diaSemana+1).' day');
					while($diaSemana < 6){
						echo '<td class="vazio mes-seguinte">', $date->format('d'),'</td>';
						$date->modify('+1 day');
						$diaSemana++;
					}
				}
				
				echo '</tr>';
				
				?>
			</table>
		</form>
		
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        
    </body>
</html>