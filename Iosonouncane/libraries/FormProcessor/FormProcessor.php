<?php
class FormProcessor {
	// I metodi che aiutano a processare le form
	
	
	var $tags = "<a><img><b><strong><em><i><ul><li><ol><p><br>";
	 
	 
	public function cleanHtml($html){
		$tmp = $html;
		
		//$html = strip_tags($html,$tags);
		
		while(true) {
			// tutto quello che non va bene lo sostituisce
			$html = preg_replace('/(<[^>]*)javascript:([^>]*>)/i', ' ', $html); // elimina tag e javascript 
			
			if ($html == $tmp)
				break;
			$tmp = $html;
		}
		
		// toglie gli acapo, tabulazioni e nuove linee
		$string = str_replace("\r", '', $string);   
		$string = str_replace("\n", ' ', $string);   
		$string = str_replace("\t", ' ', $string); 
		// toglie gli spazi multipli
		$string = trim(preg_replace('/ {2,}/', ' ', $string));
		
		exit($html);
	}
	
}
?>