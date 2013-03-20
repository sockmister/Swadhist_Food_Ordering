<?
ini_set('date.timezone', 'Asia/Singapore');

class Report {
	var $title, $elements;
	private static $GOOGLE_URL = "http://chart.googleapis.com/chart";
	public function __construct($title, $elements) {
		$this->title = $title;
		$this->elements = $elements;
	}
	
	
	public function getPieChartLink($limit = 10, $color = "FF9900", $width = 500, $height = 300, $dimension = "p3") {
		$labels = array();
		$data = array();
		$total = 0;
		$count = 0;
		foreach($this->elements as $element) {
			$total  += intval($element->data);
			if ($count <= $limit) {
				$labels[$count] = $element->getLabel();
				$data[$count] = $element->getData();
			} else {
				$labels[$limit] = "others";
				$data[$limit] += $element->getData();
			}
			$count++;
		}
		// change to percentage
		/*
		$count = 0;
		foreach($data as $element) {
			$data[$count] = intval($element*100/$total );
			$count++;
		}
		*/
		
		$img =  Report::$GOOGLE_URL;
		$img .= "?chxs=0,3072F3,15";
		$img .= "&chxt=x";
		$img .= "&chs=".$width."x".$height;
   		$img .= "&cht=".$dimension;
		$img .= "&chco=".$color;
 		$img .= "&chd=t:".implode(",", $data);
   		$img .= "&chdl=".implode("|", $labels);
		$img .= "&chdlp=t";
		$img .= "&chp=4.7";
   		$img .= "&chl=".implode("|", $data);
   		$img .= "&chma=|2,3";
   		$img .= "&chtt=".$this->title;
   		$img .= "&chts=030000,18.167";
		return $img;
	}
}

class ReportData {
	var $label, $data, $type;
	public static $TYPES = array("HourlySelling");
	
	public function getLabel() {
		switch($this->type) {
			case ReportData::$TYPES[0]: 
				return ReportData::displayTime($this->label);
			break;
			default:
				return $this->label;
		}
	}
	
	public function getData() {
		switch($type) {
			default:
				return $this->data;
		}
	}
	
	static function displayTime($float_time) {
		$endString = intval($float_time*60)%60;
		if ($endString < 10)
			$endString = "0".$endString;
		return (intval($float_time)).":".$endString;
	}
}

class StallReportModel extends CI_Model {
	private static $db;
    function __construct() {
        // Call the Model constructor
    	parent::__construct();
    	self::$db = &get_instance()->db;
    }
	
	public static function reportHourlySelling($stall_id, $period = NULL) {
		$sql = "
			SELECT slots.start_at AS label, SUM(orders.quantity) AS data, ? AS type 
			FROM orders, slots
			WHERE  orders.slot_id = slots.id AND stall_id = ? ".StallReportModel::sqlDateDiffByPeriodType($period)." AND orders.status = 2
			GROUP BY orders.slot_id 
			ORDER BY SUM(orders.quantity) DESC, slots.start_at
		";
		return new Report("Hourly Selling", self::$db->query($sql, array(ReportData::$TYPES[0], $stall_id))->result('ReportData'));
		
	}
	
	public static function bestSellers($stall_id, $period = NULL) {
		$sql = "
			SELECT dishes.name AS label,  SUM(orders.quantity) AS data, ? AS type 
			FROM orders, dishes
			WHERE orders.dish_id = dishes.id AND stall_id = ? ".StallReportModel::sqlDateDiffByPeriodType($period)." AND orders.status = 2
			GROUP BY orders.dish_id, dishes.name
			ORDER BY SUM(orders.quantity) DESC
		";
		return new Report("Best Sellers", self::$db->query($sql, array("", $stall_id))->result('ReportData'));
	}
	
	public static function sqlDateDiffByPeriodType($period) {
		if ($period == NULL) {
			return "";
		}
		$current =  getdate();
		$date_diff_sql = " AND DATEDIFF('".$current['year'].'-'.$current['mon'].'-'.$current['mday']."', orders.order_date)";
		return $date_diff_sql." <= ".intval($period);
	}
	
	
	//
	public static function getYearSales($stall_id){
		$sql = "
			SELECT SUM(orders.quantity*dishes.price) as revenue, MONTH(orders.order_date) as month, YEAR(orders.order_date) as year
			FROM orders, dishes
			WHERE dishes.id = orders.dish_id AND dishes.stall_id = ".$stall_id." AND orders.status = 2
			GROUP BY YEAR(orders.order_date), MONTH(orders.order_date)
			ORDER BY year, month
				";
		return self::$db->query($sql)->result();
	}
	
	public static function getMonthSales($stall_id, $year, $month){	
		$sql = "
			SELECT SUM(orders.quantity*dishes.price) as revenue, YEAR(orders.order_date) as year, MONTH(orders.order_date) as month, DAY(orders.order_date) as date
			FROM orders, dishes
			WHERE dishes.id = orders.dish_id AND dishes.stall_id = ".$stall_id." AND orders.status = 2 AND
					MONTH(orders.order_date) = ".$month." AND YEAR(orders.order_date) = ".$year."
			GROUP BY MONTH(orders.order_date), DAY(orders.order_date)
			ORDER BY month, date
				";	
		return self::$db->query($sql)->result();
	}
	
	public static function getDaySales($stall_id, $year, $month, $day){
		$sql = "
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
					   dishes.name, (orders.quantity * dishes.price) AS price
			FROM orders, dishes 
			WHERE orders.dish_id = dishes.id AND orders.status = '2' AND dishes.stall_id =".$stall_id."  
					AND YEAR(orders.order_date) = ".$year." 
					AND MONTH(orders.order_date) = ".$month." 
					AND DAY(orders.order_date) = ".$day."
								 ";
		return self::$db->query($sql)->result();
	}
	
	public static function getDayResolveSales($stall_id, $year, $month, $day){
		$sql = "
			SELECT orders.id AS id, orders.user_id, orders.quantity, orders.order_date, orders.order_time, 
					   dishes.name, (orders.quantity * dishes.price) AS price
			FROM orders, dishes 
			WHERE orders.dish_id = dishes.id AND orders.status = '4' AND dishes.stall_id =".$stall_id."  
					AND YEAR(orders.order_date) = ".$year." 
					AND MONTH(orders.order_date) = ".$month." 
					AND DAY(orders.order_date) = ".$day."
		";
		
		return self::$db->query($sql)->result();
	}
	
}

?>
