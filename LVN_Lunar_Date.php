<?php
if ( ! class_exists( 'LVN_Lunar_Date' ) ) {
	class LVN_Lunar_Date {
		public $day;
		public $month;
		public $year;
		public $leap;
		public $jd;

		public function __construct( $day, $month, $year, $leap, $jd ) {
			$this->day   = $day;
			$this->month = $month;
			$this->year  = $year;
			$this->leap  = $leap;
			$this->jd    = $jd;
		}
	}
}