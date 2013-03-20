<?

function isAjax() {
    return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH']=="XMLHttpRequest");
} 

function convertTime($time) {
	$endString = intval($time*60)%60;
	if ($endString < 10)
		$endString = "0".$endString;
	return (intval($time)).":".$endString;
}
?>