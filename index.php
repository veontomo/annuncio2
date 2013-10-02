<!DOCTYPE html>
<html>
<head>
	<title>Filtra annunci</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/helper.js"></script>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helpers.php';
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'retrieveDefault.php';
	$keywords = isset($_POST['keywords']) ?	htmlspecialchars(strtolower($_POST['keywords'])) : "";
	$endtime = isset($_POST['end-time']) ? setEndTime($_POST['end-time']) : strtotime('-1 hour');
	$url = isset($_POST['targetURL']) ? htmlspecialchars($_POST['targetURL']) : NULL;
	$ad = retrieveDefault($url, $endtime);
	$adSelected = filterAds($ad, $keywords);
	
	?>
	<div id="header">
		<p>
			filtro subito
		</p>
	</div>
	
	<div id="main">
		<div id="sidebar">
			<div class="date">
				<?php
					echo date("j M H:i", time());
				?>
			</div>
		</div>
		<div id="central">
			<h1>
				Filtra annunci
			</h1>
			<form method="post" action="#">
				<label for="keywords">Categoria:</label>
					<select name="targetURL" id="targetURL">
						<option value=''>
							scegli l'origine
						</option>
						<option value='http://www.subito.it/annunci-lazio/tutto/veicoli/'>
							subito, auto
						</option>
						<option value='http://www.subito.it/annunci-lazio/vendita/arredamento-casalinghi/'>
							subito, arredamenti
						</option>
						<option value='http://www.subito.it/annunci-lazio/vendita/offerte-lavoro/'>
							subito, offerte lavoro
						</option>
					</select>
						<br />

				<label for="keywords">Parole chiave:</label>
					<input type="text" name="keywords" id="keywords" 
						value="<?php echo isset($keywords) ? $keywords : "inserisci i keywords"?>"><br />
				
				<label for="end-time">Non pi&ugrave; vecchi di:</label>
					<select id="end-time" name="end-time">
						<?php echo dropDownListForEndTime($endtime) ; ?>
					</select>
				<input type="submit" value="Controlla" name="submit" id="submit">
			</form>
			<div id="all-ads"> 
				<?php
				if(count($adSelected)>0){
					echo 'Tra di loro solo questi contengono parole chiave:<br />';
					foreach($adSelected as $ad){
						echo $ad->pubdate, ': <a href="'.$ad->url.'" target="_blank">', $ad->content, '</a><br />';
					}
				}else{
					echo 'Tra gli annunci non ci sono che soddisfino i criteri.<br />';
				}
				?>
			</div>
		</div>
	</div> <!-- end of main -->

</body>


</html> 