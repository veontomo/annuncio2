<!DOCTYPE html>

<html>
<head>
	<title>I tuoi annunci</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/helper.js"></script>
</head>

<body>
	<?php
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'helpers.php';

	if(isset($_POST['submit'])){
		$keywords = isset($_POST['keywords']) ? 
			htmlspecialchars(strtolower($_POST['keywords'])) : "";
		$endtime = isset($_POST['time-end']) ? setEndTime($_POST['time-end']) : strtotime('-1 hour');
	}
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'retrieveDefault.php';
	require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'helpers'.DIRECTORY_SEPARATOR.'createOutput.php';
	
	?>
	<h1>
		Annunci
	</h1>
	<p>
		<?php
		if(isset($origin->url)) {
			echo "La sorgente: <a href=\"{$origin->url}\">{$origin->url}</a>";
		}
		?>
	</p>
	<form method="post" action="#">
		Inserisci i keyword: 
			<input type="text" name="keywords" 
				value="<?php echo isset($keywords) ? $keywords : "inserisci i keywords"?>">
		Non pi&ugrave; vecchi di: 
			<select id="time-end"name="time-end">
				<?php echo dropDownListForEndTime($endtime) ; ?>
			</select>
		<input type="submit" value="Controlla" name="submit">
	</form>
<div id="all-ads"> 

<?php
if(count($adSelected)>0){
	echo 'Tra di loro solo questi contengono parole chiave:<br />';
	foreach($adSelected as $ad){
		echo $ad->pubdate, ': <a href="'.$ad->url.'">', $ad->content, '</a><br />';
	}
}else{
	echo 'Nessun annuncio con queste parole chiave trovato.<br />';
}
?>
</div>

</body>

</html> 