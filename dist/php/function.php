<?php
class func_php{
	public function numtoword_eng($num = false){
		$num = str_replace(array(',', ' '), '' , trim($num));
		if(! $num) {
			return false;
		}
		$num = (int) $num;
		$words = array();
		$list1 = array('', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE', 'TEN', 'ELEVEN',
			'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'
		);
		$list2 = array('', 'TEN', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY', 'HUNDRED');
		$list3 = array('', 'THOUSAND', 'MILLION', 'BILLION', 'TRILLION', 'QUADRILLION', 'QUINTILLION', 'SEXTILLION', 'SEPTILLION',
			'OCTILLION', 'NONILLION', 'DECILLION', 'UNDECILLION', 'DUODECILLION', 'TREDECILLION', 'QUATTUORDECILLION',
			'QUINDECILLION', 'SEXDECILLION', 'SEPTENDECILLION', 'OCTODECILLION', 'NOVEMDECILLION', 'VIGINTILLION'
		);
		$num_length = strlen($num);
		$levels = (int) (($num_length + 2) / 3);
		$max_length = $levels * 3;
		$num = substr('00' . $num, -$max_length);
		$num_levels = str_split($num, 3);
		for ($i = 0; $i < count($num_levels); $i++) {
			$levels--;
			$hundreds = (int) ($num_levels[$i] / 100);
			$hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' HUNDRED' . ' ' : '');
			$tens = (int) ($num_levels[$i] % 100);
			$singles = '';
			if ( $tens < 20 ) {
				$tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
			} else {
				$tens = (int)($tens / 10);
				$tens = ' ' . $list2[$tens] . ' ';
				$singles = (int) ($num_levels[$i] % 10);
				$singles = ' ' . $list1[$singles] . ' ';
			}
			$words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
		} //end for loop
		$commas = count($words);
		if ($commas > 1) {
			$commas = $commas - 1;
		}
		return implode(' ', $words);
	}
	function getfileattechname($file){
		$extension = explode(".",$file);
		$ext = $extension[count($extension) - 1];
		switch ($ext) {
			case "png":
				 $fileattach = date('ymdhis').".".$ext;
				break;
			case "jpg":
				 $fileattach = date('ymdhis').".".$ext;
				break;
			case "jpeg":
				 $fileattach = date('ymdhis').".".$ext;
				break;
			case "gif":
				 $fileattach = date('ymdhis').".".$ext;
				break;
			case "pdf":
				 $fileattach = date('ymdhis').".".$ext;
			break;
		}
		return $fileattach;
	}
}
?>