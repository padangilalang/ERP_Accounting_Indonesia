<?php
class waktu {
	public static function getInstance()
	{
		$classname=__CLASS__;
		return new $classname;
	}

	public function nicetime($date)
	{
		if(empty($date)) {
			return "No date provided";
		}

		$periods         = array("detik", "menit", "jam", "hari", "minggu", "bulan", "tahun", "dekade");
		$lengths         = array("60","60","24","7","4.35","12","10");

		$now             = time();
		//$unix_date         = strtotime($date);
		$unix_date         = $date;

		// check validity of date
		if(empty($unix_date)) {
			return "Salah Format";
		}

		// is it future date or past date
		if($now >= $unix_date) {
			$difference     = $now - $unix_date;
			$tense         = "yang lalu";

		} else {
			$difference     = $unix_date - $now;
			$tense         = "dari sekarang";
		}

		for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
			$difference /= $lengths[$j];
		}

		$difference = round($difference);

		if($difference != 1) {
			$periods[$j].= "";
		}

		return "$difference $periods[$j] {$tense}";
	}
}


?>

