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
	$keywords = isset($_POST['keywords']) ?	htmlspecialchars(strtolower($_POST['keywords'])) : "";
	$endtime = isset($_POST['end-time']) ? setEndTime($_POST['end-time']) : strtotime('-1 hour');
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'retrieveDefault.php';
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'createOutput.php';
	
	?>
	<div id="header">
		<?php
		if(isset($origin->url)) {
			echo "<a href=\"{$origin->url}\" target=\"blank\">{$origin->url}</a>";
		}
		?>
	</div>
	
	<div id="main">
		<div id="sidebar">
			<div class="date">
				<?php
					echo date("j M h:i", time());
				?>
			</div>
		</div>
		<div id="central">
			<h1>
				Filtra annunci
			</h1>
			<form method="post" action="#">
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
						echo $ad->pubdate, ': <a href="'.$ad->url.'" target="blank">', $ad->content, '</a><br />';
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