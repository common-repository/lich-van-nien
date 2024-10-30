<?php
/**
 * Created by PhpStorm.
 * User: datcx
 * Date: 2019-06-22
 * Time: 11:29
 */
if ( ! class_exists( 'LVN_Lunar' ) ) {
	class LVN_Lunar {
        protected $convert;
		// Init function construct
		function __construct() {
		    $convert = new LVN_Convert_Date();
		    $this->convert = $convert;
			$this->init();
		}

		public $century_19;
		public $century_20;
		public $century_21;
		public $century_22;
		public $can;
		public $chi;
		public $week;
		public $hours_zodiac;
		public $tietkhi;

		public $first_day;
		public $last_day;
		public $today;
		public $current_lunar_date;
		public $current_month;
		public $current_year;

		public $day_name;
		public $print_options;
		public $font_size;
		public $tab_width;
		public $columns; // Default columns when show year


		public $pi;

		public function init() {
			$this->century_19   = array(
				0x30baa3,
				0x56ab50,
				0x422ba0,
				0x2cab61,
				0x52a370,
				0x3c51e8,
				0x60d160,
				0x4ae4b0,
				0x376926,
				0x58daa0,
				0x445b50,
				0x3116d2,
				0x562ae0,
				0x3ea2e0,
				0x28e2d2,
				0x4ec950,
				0x38d556,
				0x5cb520,
				0x46b690,
				0x325da4,
				0x5855d0,
				0x4225d0,
				0x2ca5b3,
				0x52a2b0,
				0x3da8b7,
				0x60a950,
				0x4ab4a0,
				0x35b2a5,
				0x5aad50,
				0x4455b0,
				0x302b74,
				0x562570,
				0x4052f9,
				0x6452b0,
				0x4e6950,
				0x386d56,
				0x5e5aa0,
				0x46ab50,
				0x3256d4,
				0x584ae0,
				0x42a570,
				0x2d4553,
				0x50d2a0,
				0x3be8a7,
				0x60d550,
				0x4a5aa0,
				0x34ada5,
				0x5a95d0,
				0x464ae0,
				0x2eaab4,
				0x54a4d0,
				0x3ed2b8,
				0x64b290,
				0x4cb550,
				0x385757,
				0x5e2da0,
				0x4895d0,
				0x324d75,
				0x5849b0,
				0x42a4b0,
				0x2da4b3,
				0x506a90,
				0x3aad98,
				0x606b50,
				0x4c2b60,
				0x359365,
				0x5a9370,
				0x464970,
				0x306964,
				0x52e4a0,
				0x3cea6a,
				0x62da90,
				0x4e5ad0,
				0x392ad6,
				0x5e2ae0,
				0x4892e0,
				0x32cad5,
				0x56c950,
				0x40d4a0,
				0x2bd4a3,
				0x50b690,
				0x3a57a7,
				0x6055b0,
				0x4c25d0,
				0x3695b5,
				0x5a92b0,
				0x44a950,
				0x2ed954,
				0x54b4a0,
				0x3cb550,
				0x286b52,
				0x4e55b0,
				0x3a2776,
				0x5e2570,
				0x4852b0,
				0x32aaa5,
				0x56e950,
				0x406aa0,
				0x2abaa3,
				0x50ab50
			);
			$this->century_20   = array(
				0x3c4bd8,
				0x624ae0,
				0x4ca570,
				0x3854d5,
				0x5cd260,
				0x44d950,
				0x315554,
				0x5656a0,
				0x409ad0,
				0x2a55d2,
				0x504ae0,
				0x3aa5b6,
				0x60a4d0,
				0x48d250,
				0x33d255,
				0x58b540,
				0x42d6a0,
				0x2cada2,
				0x5295b0,
				0x3f4977,
				0x644970,
				0x4ca4b0,
				0x36b4b5,
				0x5c6a50,
				0x466d50,
				0x312b54,
				0x562b60,
				0x409570,
				0x2c52f2,
				0x504970,
				0x3a6566,
				0x5ed4a0,
				0x48ea50,
				0x336a95,
				0x585ad0,
				0x442b60,
				0x2f86e3,
				0x5292e0,
				0x3dc8d7,
				0x62c950,
				0x4cd4a0,
				0x35d8a6,
				0x5ab550,
				0x4656a0,
				0x31a5b4,
				0x5625d0,
				0x4092d0,
				0x2ad2b2,
				0x50a950,
				0x38b557,
				0x5e6ca0,
				0x48b550,
				0x355355,
				0x584da0,
				0x42a5b0,
				0x2f4573,
				0x5452b0,
				0x3ca9a8,
				0x60e950,
				0x4c6aa0,
				0x36aea6,
				0x5aab50,
				0x464b60,
				0x30aae4,
				0x56a570,
				0x405260,
				0x28f263,
				0x4ed940,
				0x38db47,
				0x5cd6a0,
				0x4896d0,
				0x344dd5,
				0x5a4ad0,
				0x42a4d0,
				0x2cd4b4,
				0x52b250,
				0x3cd558,
				0x60b540,
				0x4ab5a0,
				0x3755a6,
				0x5c95b0,
				0x4649b0,
				0x30a974,
				0x56a4b0,
				0x40aa50,
				0x29aa52,
				0x4e6d20,
				0x39ad47,
				0x5eab60,
				0x489370,
				0x344af5,
				0x5a4970,
				0x4464b0,
				0x2c74a3,
				0x50ea50,
				0x3d6a58,
				0x6256a0,
				0x4aaad0,
				0x3696d5,
				0x5c92e0
			);
			$this->century_21   = array(
				0x46c960,
				0x2ed954,
				0x54d4a0,
				0x3eda50,
				0x2a7552,
				0x4e56a0,
				0x38a7a7,
				0x5ea5d0,
				0x4a92b0,
				0x32aab5,
				0x58a950,
				0x42b4a0,
				0x2cbaa4,
				0x50ad50,
				0x3c55d9,
				0x624ba0,
				0x4ca5b0,
				0x375176,
				0x5c5270,
				0x466930,
				0x307934,
				0x546aa0,
				0x3ead50,
				0x2a5b52,
				0x504b60,
				0x38a6e6,
				0x5ea4e0,
				0x48d260,
				0x32ea65,
				0x56d520,
				0x40daa0,
				0x2d56a3,
				0x5256d0,
				0x3c4afb,
				0x6249d0,
				0x4ca4d0,
				0x37d0b6,
				0x5ab250,
				0x44b520,
				0x2edd25,
				0x54b5a0,
				0x3e55d0,
				0x2a55b2,
				0x5049b0,
				0x3aa577,
				0x5ea4b0,
				0x48aa50,
				0x33b255,
				0x586d20,
				0x40ad60,
				0x2d4b63,
				0x525370,
				0x3e49e8,
				0x60c970,
				0x4c54b0,
				0x3768a6,
				0x5ada50,
				0x445aa0,
				0x2fa6a4,
				0x54aad0,
				0x4052e0,
				0x28d2e3,
				0x4ec950,
				0x38d557,
				0x5ed4a0,
				0x46d950,
				0x325d55,
				0x5856a0,
				0x42a6d0,
				0x2c55d4,
				0x5252b0,
				0x3ca9b8,
				0x62a930,
				0x4ab490,
				0x34b6a6,
				0x5aad50,
				0x4655a0,
				0x2eab64,
				0x54a570,
				0x4052b0,
				0x2ab173,
				0x4e6930,
				0x386b37,
				0x5e6aa0,
				0x48ad50,
				0x332ad5,
				0x582b60,
				0x42a570,
				0x2e52e4,
				0x50d160,
				0x3ae958,
				0x60d520,
				0x4ada90,
				0x355aa6,
				0x5a56d0,
				0x462ae0,
				0x30a9d4,
				0x54a2d0,
				0x3ed150,
				0x28e952
			);
			$this->century_22   = array(
				0x4eb520,
				0x38d727,
				0x5eada0,
				0x4a55b0,
				0x362db5,
				0x5a45b0,
				0x44a2b0,
				0x2eb2b4,
				0x54a950,
				0x3cb559,
				0x626b20,
				0x4cad50,
				0x385766,
				0x5c5370,
				0x484570,
				0x326574,
				0x5852b0,
				0x406950,
				0x2a7953,
				0x505aa0,
				0x3baaa7,
				0x5ea6d0,
				0x4a4ae0,
				0x35a2e5,
				0x5aa550,
				0x42d2a0,
				0x2de2a4,
				0x52d550,
				0x3e5abb,
				0x6256a0,
				0x4c96d0,
				0x3949b6,
				0x5e4ab0,
				0x46a8d0,
				0x30d4b5,
				0x56b290,
				0x40b550,
				0x2a6d52,
				0x504da0,
				0x3b9567,
				0x609570,
				0x4a49b0,
				0x34a975,
				0x5a64b0,
				0x446a90,
				0x2cba94,
				0x526b50,
				0x3e2b60,
				0x28ab61,
				0x4c9570,
				0x384ae6,
				0x5cd160,
				0x46e4a0,
				0x2eed25,
				0x54da90,
				0x405b50,
				0x2c36d3,
				0x502ae0,
				0x3a93d7,
				0x6092d0,
				0x4ac950,
				0x32d556,
				0x58b4a0,
				0x42b690,
				0x2e5d94,
				0x5255b0,
				0x3e25fa,
				0x6425b0,
				0x4e92b0,
				0x36aab6,
				0x5c6950,
				0x4674a0,
				0x31b2a5,
				0x54ad50,
				0x4055a0,
				0x2aab73,
				0x522570,
				0x3a5377,
				0x6052b0,
				0x4a6950,
				0x346d56,
				0x585aa0,
				0x42ab50,
				0x2e56d4,
				0x544ae0,
				0x3ca570,
				0x2864d2,
				0x4cd260,
				0x36eaa6,
				0x5ad550,
				0x465aa0,
				0x30ada5,
				0x5695d0,
				0x404ad0,
				0x2aa9b3,
				0x50a4d0,
				0x3ad2b7,
				0x5eb250,
				0x48b540,
				0x33d556
			);
			$this->can          = array( 'Giáp', 'Ất', 'Bính', 'Đinh', 'Mậu', 'Kỷ', 'Canh', 'Tân', 'Nhâm', 'Quý' );
			$this->chi          = array(
				'Tý',
				'Sửu',
				'Dần',
				'Mão',
				'Thìn',
				'Tỵ',
				'Ngọ',
				'Mùi',
				'Thân',
				'Dậu',
				'Tuất',
				'Hợi',
			);
			$this->week         = array( 'Chủ nhật', 'Thứ hai', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7' );
			$this->hours_zodiac = array(
				"110100101100",
				"001101001011",
				"110011010010",
				"101100110100",
				"001011001101",
				"010010110011"
			);
			$this->tietkhi      = array(
				'Xuân phân',
				'Thanh minh',
				'Cốc vũ',
				'Lập hạ',
				'Tiểu mãn',
				'Mang chủng',
				'Hạ chí',
				'Tiểu thử',
				'Đại thử',
				'Lập thu',
				'Xử thử',
				'Bạch lộ',
				'Thu phân',
				'Hàn lộ',
				'Sương giáng',
				'Lập đông',
				'Tiểu tuyết',
				'Đại tuyết',
				'Đông chí',
				'Tiểu hàn',
				'Đại hàn',
				'Lập xuân',
				'Vũ thủy',
				'Kinh trập'
			);

			$this->pi                 = pi();
			$this->first_day          = $this->jdn( 25, 1, 1800 );
			$this->last_day           = $this->jdn( 31, 12, 2199 );
			$this->today              = DateTime::createFromFormat( 'd/m/Y', date( 'd/m/Y' ) );
			$this->current_lunar_date = $this->get_lunar_date( date_format( $this->today, 'd' ), date_format( $this->today, 'm' ), date_format( $this->today, 'Y' ) );
			$this->current_month      = date_format( $this->today, 'm' );
			$this->current_year       = date_format( $this->today, 'Y' );
			$this->day_name           = [ "CN", "T2", "T3", "T4", "T5", "T6", "T7" ];
			$this->print_options      = array(
				'font_size'   => '13px',
				'table_width' => '420px'
			);
			$this->font_size          = [ "9pt", "13pt", "17pt" ];
			$this->tab_width          = [ "180px", "420px", "600px" ];
			$this->columns            = 3;
		}

		/**
		 * Set lunar date
		 * params: $day, $month, $year, $leap, $jb
		 * return: void() */
		public function set_lunar_date( $day, $month, $year, $leap, $jd ) {
			return new LVN_Lunar_Date( $day, $month, $year, $leap, $jd );
		}

		/**
		 * Floor number
		 * Params: $number
		 * return: int */
		public function floor_number( $number ) {
			return floor( $number );
		}

		/**
		 * jdn
		 * params: $day, $month, $year
		 * return: int */
		public function jdn( $day, $month, $year ) {
			$m_floor = $this->floor_number( ( 14 - $month ) / 12 );
			$y       = $year + 4800 - $m_floor;
			$m       = $month + 12 * $m_floor - 3;
			$jd      = $day + $this->floor_number( ( 153 * $m + 2 ) / 5 ) + 365 * $y + $this->floor_number( $y / 4 ) - $this->floor_number( $y / 100 ) + $this->floor_number( $y / 400 ) - 32045;

			return $jd;
		}

		/**
		 * jdn to date
		 * params: $jd
		 * return array($day,$month,$year) */
		public function jdn_to_date( $jd ) {
			$jd_temp = $jd;
			if ( $jd_temp < 2299161 ) {
				$a = $jd_temp;
			} else {
				$alpha = $this->floor_number( ( $jd_temp - 1867216.25 ) / 36524.25 );
				$a     = $jd_temp + 1 + $alpha - $this->floor_number( $alpha / 4 );
			}
			$b   = $a + 1524;
			$c   = $this->floor_number( ( $b - 122.1 ) / 365.25 );
			$d   = $this->floor_number( 365.25 * $c );
			$e   = $this->floor_number( ( $b - $d ) / 30.6001 );
			$day = $this->floor_number( $b - $d - $this->floor_number( 30.6001 * $e ) );
			if ( $e < 14 ) {
				$month = $e - 1;
			} else {
				$month = $e - 13;
			}
			if ( $month < 3 ) {
				$year = $c - 4715;
			} else {
				$year = $c - 4716;
			}

			return [ $day, $month, $year ];
		}

		public function decode_lunar_year( $year, $k ) {
			$result             = [];
			$month_lengths      = [ 29, 30 ];
			$month_regular      = array_fill( 0, 12, 0 );
			$offset_tet         = $k >> 17;
			$leap_month         = $k & 0xf;
			$leap_month_lengths = $month_lengths[ $k >> 16 & 0x1 ];
			$solar_nd           = $this->jdn( 1, 1, $year );
			$current_jd         = $solar_nd + $offset_tet;
			$j                  = $k >> 4;
			for ( $i = 0; $i < 12; $i ++ ) {
				$month_regular[ 12 - $i - 1 ] = $month_lengths[ $j & 0x1 ];
				$j                            >>= 1;
			}
			if ( $leap_month == 0 ) {
				for ( $m = 1; $m <= 12; $m ++ ) {
					$result[]   = $this->set_lunar_date( 1, $m, $year, 0, $current_jd );
					$current_jd += $month_regular[ $m - 1 ];
				}
			} else {
				for ( $m = 1; $m < $leap_month; $m ++ ) {
					$result[] = $this->set_lunar_date( 1, $m, $year, 0, $current_jd );
				}
				$result[]   = $this->set_lunar_date( 1, $leap_month, $year, 1, $current_jd );
				$current_jd += $leap_month_lengths;
				for ( $m = $leap_month + 1; $m <= 12; $m ++ ) {
					$result[]   = $this->set_lunar_date( 1, $m, $year, 0, $current_jd );
					$current_jd += $month_regular[ $m - 1 ];
				}
			}

			return $result;
		}

		/**
		 * get year info
		 * params: $year
		 * return list year decode_lunar_year */
		public function get_year_info( $year ) {
			if ( $year < 1900 ) {
				$year_code = $this->century_19[ $year - 1800 ];
			} elseif ( $year < 2000 ) {
				$year_code = $this->century_20[ $year - 1900 ];
			} elseif ( $year < 2100 ) {
				$year_code = $this->century_21[ $year - 2000 ];
			} else {
				$year_code = $this->century_22[ $year - 2100 ];
			}

			return $this->decode_lunar_year( $year, $year_code );
		}

		public function find_lunar_date( $jd, $lunar_year ) {
			if ( $jd > $this->last_day || $jd < $this->first_day || $lunar_year[0]->jd > $jd ) {
				return $this->set_lunar_date( 0, 0, 0, 0, $jd );
			}
			$i = count( $lunar_year ) - 1;
			while ( $jd < $lunar_year[ $i ]->jd ) {
				$i --;
			}
			$off = $jd - $lunar_year[ $i ]->jd;

			return $this->set_lunar_date( $lunar_year[ $i ]->day + $off, $lunar_year[ $i ]->month, $lunar_year[ $i ]->year, $lunar_year[ $i ]->leap, $jd );
		}

		public function get_lunar_date( $day, $month, $year ) {
			if ( $year < 1800 || 2199 < $year ) {

			}
			$lunar_year = $this->get_year_info( $year );
			$jd         = $this->jdn( $day, $month, $year );
			if ( $jd < $lunar_year[0]->jd ) {
				$lunar_year = $this->get_year_info( $year - 1 );
			}

			return $this->convert->convert_solar_to_lunar($day,$month,$year);
		}

		public function sun_longitude( $jdn ) {
			$time        = ( $jdn - 2451545.0 ) / 36525;
			$degree      = $this->pi / 180;
			$mean        = 357.52910 + 35999.05030 * $time - 0.0001559 * $time * $time - 0.00000048 * $time * $time * $time;
			$long        = 280.46645 + 36000.76983 * $time + 0.0003032 * $time * $time;
			$degree_long = ( 1.914600 - 0.004817 * $time - 0.000014 * $time * $time ) * sin( $degree * $mean );
			$degree_long = $degree_long + ( 0.019993 - 0.000101 * $time ) * sin( $degree * 2 * $mean ) + 0.000290 * sin( $degree_long * 3 * $mean );
			$theta       = $long + $degree_long;
			$omega       = 125.04 - 1934.136 * $time;
			$lamda       = $theta - 0.00569 - 0.00478 * sin( $omega * $degree_long );
			$lamda       = $lamda * $degree_long;
			$lamda       = $lamda - $this->pi * 2 * ( $this->floor_number( $lamda / ( $this->pi * 2 ) ) );

			return $lamda;
		}

		function get_sun_longitude( $day_number, $timezone ) {
			return $this->floor_number( $this->sun_longitude( $day_number - 0.5 - $timezone / 24.0 ) / $this->pi * 12 );
		}

		public function get_select_month() {
			if ( isset( $_GET['mm'] ) ) {
				$current_month = sanitize_text_field( $_GET['mm'] );
				if ( $current_month > 0 && $current_month <= 12 ) {
					$this->current_month = $current_month;
				}
			}
			if ( isset( $_GET['yy'] ) ) {
				$current_year = sanitize_text_field( $_GET['yy'] );
				if ( $current_year >= 1900 && $current_year <= 2200 ) {
					$this->current_year = $current_year;
				}
			}
		}

		public function get_month( $month, $year ) {
			if ( $month < 12 ) {
				$mm = $month + 1;
				$yy = $year;
			} else {
				$mm = 1;
				$yy = $year + 1;
			}
			$jd1    = $this->jdn( 1, $month, $year );
			$jd2    = $this->jdn( 1, $mm, $yy );
			$ly1    = $this->get_year_info( $year );
			$tet1   = $ly1[0]->jd;
			$result = [];
			if ( $tet1 <= $jd1 ) {
				for ( $i = $jd1; $i < $jd2; $i ++ ) {
					$result[] = $this->find_lunar_date( $i, $ly1 );
				}
			} elseif ( $jd1 < $tet1 && $jd2 < $tet1 ) {
				$ly1 = $this->get_year_info( $year - 1 );
				for ( $i = $jd1; $i < $jd2; $i ++ ) {
					$result[] = $this->find_lunar_date( $i, $ly1 );
				}
			} elseif ( $jd1 < $tet1 && $tet1 <= $jd2 ) {
				$ly2 = $this->get_year_info( $year - 1 );
				for ( $i = $jd1; $i < $tet1; $i ++ ) {
					$result[] = $this->find_lunar_date( $i, $ly2 );
				}
				for ( $i = $tet1; $i < $jd2; $i ++ ) {
					$result[] = $this->find_lunar_date( $i, $ly1 );
				}
			}

			return $result;
		}

		public function get_can_chi( $lunar_date ) {
			$day_name   = $this->can[ ( $lunar_date->jd + 9 ) % 10 ] . ' ' . $this->chi[ ( $lunar_date->jd + 1 ) % 12 ];
			$month_name = $this->can[ ($lunar_date->year * 12 + $lunar_date->month + 3)%10 ] . ' ' . $this->chi[ ( $lunar_date->month + 1 ) % 12 ];
			if ( $lunar_date->leap == 1 ) {
				$month_name .= " (nhuận)";
			}
			$year_name = $this->get_year_can_chi( $lunar_date->year );

			return [ $day_name, $month_name, $year_name ];
		}

		public function get_day_name( $lunar_date ) {
			if ( $lunar_date->day == 0 ) {
				return '';
			}
			$canchi   = $this->get_can_chi( $lunar_date );
			$day_name = "Ngày " . $canchi[0] . "<br> Tháng " . $canchi[1] . "<br> Năm " . $canchi[2];

			return $day_name;
		}

		public function get_year_can_chi( $year ) {
			return ( $this->can[ ( $year + 6 ) % 10 ] . " " . $this->chi[ ( $year + 8 ) % 12 ] );
		}

		public function get_can_hour( $jdn ) {
			return $this->can[ ( $jdn - 1 ) * 2 % 10 ];
		}

		public function get_day_string( $lunar, $solar_day, $solar_month, $solar_year ) {
			$day_of_week = $this->week[ ( $lunar->jd + 1 ) % 7 ];
			$day         = $day_of_week . " " . $solar_day . "/" . $solar_month . "/" . $solar_year;
			$day         .= " -+- ";
			$day         .= "Ngày " . $lunar->day . " Tháng " . $lunar->month;
			if ( $lunar->leap == 1 ) {
				$day .= " nhuận";
			}

			return $day;
		}

		public function get_today_string() {
			$string = $this->get_day_string( $this->current_lunar_date, $this->today->format( 'd' ), $this->today->format( 'm' ), $this->today->format( 'Y' ) );
			$string .= " năm " . $this->get_year_can_chi( $this->current_lunar_date->year );

			return $string;
		}

		public function get_current_time() {
			$std = date_format( $this->today, 'H' );
			$min = date_format( $this->today, 'i' );
			$sec = date_format( $this->today, 's' );
			$s1  = ( $std < 10 ) ? '0' . $std : $std;
			$s2  = ( $min < 10 ) ? '0' . $min : $min;

			return $s1 . ':' . $s2;
		}

		public function get_hours_zodiac( $jd ) {
			$chi_of_day   = ( $jd + 1 ) % 2;
			$hours_zodiac = $this->hours_zodiac[ $chi_of_day % 6 ];
			$result       = '';
			$count        = 0;
			for ( $i = 0; $i < 12; $i ++ ) {
				if ( substr( $hours_zodiac, $i, 1 ) == '1' ) {
					$result .= $this->chi[ $i ];
					$result .= ' (' . ( ( $i * 2 + 23 ) % 24 ) . '-' . ( ( $i * 2 + 1 ) % 24 ) . ')';
					if ( $count ++ < 5 ) {
						$result .= ', ';
					}
					if ( $count == 3 ) {
						$result .= '';
					}
				}
			}
			return $result;
		}

		public function set_output_size( $size ) {
			if ( $size == "small" ) {
				$index = 0;
			} else if ( $size == "big" ) {
				$index = 2;
			} else {
				$index = 1;
			}
			$this->print_options = array(
				'font_size'   => $this->font_size[ $index ],
				'table_width' => $this->tab_width[ $index ]
			);
		}

		function get_prev_year_link( $month, $year ) {
			return '<a href="window.location.pathname?yy=' . ( $year - 1 ) . '&mm=' . $month . '">&lt;&lt;</a>';
		}

		function get_prev_month_link( $month, $year ) {
			$prev_month = $month > 1 ? $month - 1 : 12;
			$prev_year  = $month > 1 ? $year : $year - 1;

			return "<a class='lunar-prev' data-month='$prev_month' data-year='$prev_year' href='javascript:void(0)'></a>";
		}

		function get_next_month_link( $month, $year ) {
			$next_month = $month < 12 ? $month + 1 : 1;
			$next_year  = $month < 12 ? $year : $year + 1;

			return "<a class='lunar-next' data-month='$next_month' data-year='$next_year' href='javascript:void(0)'></a>";
		}

		function get_next_year_link( $month, $year ) {
			return '<a href="window.location.pathname+?yy=' . ( $year + 1 ) . '&mm=' . $month . '">&gt;&gt;</a>';
		}

		function print_head( $month, $year ) {
			$result     = "";
			$month_name = $month . "/" . $year;
			$result     .= '<tr><td colspan="2" class="navi-left">' . $this->get_prev_month_link( $month, $year ) . '</td>';
			$result     .= '<td colspan="3" class="month-name">' . $month_name . '</td>';
			$result     .= '<td colspan="2" class="navi-right">' . $this->get_next_month_link( $month, $year ) . '</td></tr>';

			$result .= '<tr>';
			for ( $i = 0; $i <= 6; $i ++ ) {
				$result .= '<td class="day-of-week">' . $this->day_name[ $i ] . '</td>';
			}

			return $result;
		}

		function print_empty_cell() {
			return '<td class="day-of-month"><div class=cn>&nbsp;</div> <div class=am>&nbsp;</div></td>';
		}

		function print_cell( $lunar_date, $solar_date, $solar_month, $solar_year ) {
			$cell_class  = "day-of-month";
			$solar_class = "day-working";
			$lunar_class = "date-lunar";
			$solar_color = "black";
			$dow         = ( $lunar_date->jd + 1 ) % 7;
			if ( $dow == 0 ) {
				$solar_class = 'sunday';
				$solar_color = 'red';
			} elseif ( $dow == 6 ) {
				$solar_class = 'saturday';
				$solar_color = 'green';
			}
			if ( $solar_date == date_format( $this->today, 'd' ) && $solar_month == date_format( $this->today, 'm' ) && $solar_year == date_format( $this->today, 'Y' ) ) {
				$cell_class = 'today';
			}
			if ( $lunar_date->day == 1 && $lunar_date->month == 1 ) {
				$cell_class = 'new-year';
			}
			if ( $lunar_date->leap == 1 ) {
				$lunar_class = 'am2';
			}
			$lunar = $lunar_date->day;
			if ( $solar_date == 1 || $lunar == 1 ) {
				$lunar = $lunar_date->day . '/' . $lunar_date->month;
			}
			$result = "";
			$args   = $lunar_date->day . ', ' . $lunar_date->month . ',' . $lunar_date->year . ',' . $lunar_date->leap;
			$args   .= ',' . $lunar_date->jd . ',' . $solar_date . ',' . $solar_month . ',' . $solar_year;
			$result .= '<td class="' . $cell_class . '"';
			if ( $lunar_date != null ) {
				$result .= 'title="' . $this->get_day_name( $lunar_date ) . '"';
			}
			$result .= '<div style=color:' . $solar_color . ' class="' . $solar_class . '">' . $solar_date . '</div> <div class="' . $lunar_class . '">' . $lunar . '</div></td>';

			return $result;
		}

		function print_table( $month, $year ) {
			$current_month = $this->get_month( $month, $year );
			if ( count( $current_month ) == 0 ) {
				return '';
			}
			$ld1        = $current_month[0];
			$empty_cell = ( $ld1->jd + 1 ) % 7;
			$month_head = $month . "/" . $year;
			$lunar_head = $this->get_can_chi( $ld1->year );
			$result     = "";
			$result     .= '<table class="month" border="1">';
			$result     .= $this->print_head( $month, $year );
			for ( $i = 0; $i < 6; $i ++ ) {
				$result .= ( "<tr>" );
				for ( $j = 0; $j < 7; $j ++ ) {
					$k = 7 * $i + $j;
					if ( $k < $empty_cell || $k >= $empty_cell + count( $current_month ) ) {
						$result .= $this->print_empty_cell();
					} else {
						$solar  = $k - $empty_cell + 1;
						$ld1    = $this->convert->convert_solar_to_lunar($solar,$month,$year);
						$result .= $this->print_cell( $ld1, $solar, $month, $year );
					}
				}
				$result .= "</tr>";
			}
			$result .= '</table>';

			return $result;
		}

		function print_month( $month, $year ) {
			$result = $this->print_table( $month, $year );

			return $result;
		}

		function print_selected_month() {
			$this->get_select_month();

			return $this->print_month( $this->current_month, $this->current_year );
		}

		public function print_year( $year ) {
			$year_name = "Năm " . $year;
			$result    = "";

			$result .= "<table class='year'>";
			$result .= "<tr><td colspan='3' class='year-name'>" . $year_name . "</td></tr>";
			for ( $i = 1; $i <= 12; $i ++ ) {
				if ( $i % $this->columns == 1 ) {
					$result .= '<tr>';
				}
				$result .= '<td>';
				$result .= $this->print_table( $i, $year );
				$result .= '</td>';
				if ( $i % $this->columns == 0 ) {
					$result .= '</tr>';
				}
			}
			$result .= '</table>';

			return $result;
		}

		public function print_day( $dd, $mm, $yy ) {

			$result = "";
			set_query_var( 'lunar', array(
				'lunar' => $this,
				'day'   => $dd,
				'month' => $mm,
				'year'  => $yy
			) );
			ob_start();
			require LVN_DIR . 'parts/lunar-day.php';
			$result .= ob_get_contents();
			ob_end_clean();

			return $result;
		}

	}
}