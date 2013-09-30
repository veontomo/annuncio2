<!DOCTYPE html>
<?php
	require "helpers/retrieveDefault.php";
?>
<html>
<head>
	<title>I tuoi annunci</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/helper.js"></script>
</head>

<body>
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
	<form action="php/analyze.php" method="post">
		Inserisci i keyword: <input type="text" placeholder="<?php echo isset($keywords) ? $keywords : "inserisci i keywords"?>">
		Intervallo di tempo: <input type="text" placeholder="<?php echo isset($origin->endtime) ? date("H:i M d", $origin->endtime) : "time"?>">
		<input type="submit" value="Controlla">
	</form>
<div id="all-ads"> 

<?php
if(isset($ads)){
	echo count($ads), ' annunci sono stati elaborati.<br />';
	foreach ($ads as $ad) {
		if($ad->contains($keywords)){
			$adSelected[] = $ad;
		}
	}
	if(count($adSelected)>0){
		echo 'Among them these are interesting: <br />';
		foreach($adSelected as $ad){
			echo $ad->pubdate, ': <a href="'.$ad->url.'">', $ad->content, '</a><br />';
		}
	}else{
		echo 'Nothing interesting is found!<br />';
	}
}
?>
</div>

</body>

</html> 