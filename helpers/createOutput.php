<?php
if(isset($ads)){
	foreach ($ads as $ad) {
		if($ad->contains($keywords)){
			$adSelected[] = $ad;
		}
	}

}
