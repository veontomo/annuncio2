$(document).ready(function(){
	$('#submit').click(function(){
		var keywords = $('#keywords').val();
		var endtime = $('#end-time').val();
		var target = $('#targetURL').val();

		$('#ajax-ads').remove();
		$('#all-ads').html("<img class=\"loading\" src=\"images/loading.gif\" />");
		$.post('helpers/elaborateRequest.php', 
			{
				'target'   : target,
				'keywords' : keywords,
				'end-time' : endtime
			},
			function(responce){
				$('#all-ads .loading').remove();
				var data = jQuery.parseJSON(responce);
				
				if(data.success){
					if(	data.result.length>0){
						$('<ol id="ajax-ads"></ol>').appendTo('#all-ads');
						$.each(data.result, function(key, ad){
							var adText = ad.pubdate + ' <a href="' + ad.url + '" target="blank">' + ad.content + '</a>';
							$('<li>'+ adText + '</li>').prependTo('#ajax-ads');
						})	
					}else{
						$('#all-ads').html("<div class=\"warning\">Tra gli annunci non ci sono che soddisfino i criteri.</div>");
					}
					
					
				}else{
					$('#all-ads').html("<div class=\"error\">Ci sono stati incontrati dei problemi!</div>");
				};
				
			});
		return false;
	});
})