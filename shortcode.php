<?php
if ( ! function_exists( 'show_lunar_callback' ) ) {
	function show_lunar_callback( $atts ) {
		$params         = shortcode_atts( array(
			'view'    => 'year',
			'year'    => date( 'Y' ),
			'month'   => date( 'm' ),
			'columns' => 2
		), $atts );
		$lunar          = new LVN_Lunar();
		$lunar->columns = $params['columns'];
		$result         = "";
		switch ( $params['view'] ) {
			case 'year':
				$result .= '<div class="lunar-year">';
				$result .= $lunar->print_year( $params['year'] );
				$result .= '</div>';

				return $result;
				break;
			case 'month':
				return $lunar->print_month( $params['month'], $params['year'] );
				break;
			case 'day':
				$result .= '<div class="lunar-widget">';
				$result .= '<div class="calendar-day">';
				$result .= '
				<div class="day-top">
					<a href="javascript:void(0)" class="lunar-prev"></a>
					<input value="08-07-2019" class="lunar-find-day">
					<a href="javascript:void(0)" class="lunar-next"></a>
				</div>';
				$result .='<div class="day-content">';
				$result .= $lunar->print_day( date( 'd' ), date( 'm' ), date( 'Y' ) );
				$result .= '</div>';
				$result.='</div>';
				$result .= '</div>';

				return $result;
				break;
			default:
				return $lunar->print_month( $params['month'], $params['year'] );
		}

	}
}
add_shortcode( 'show_lunar', 'show_lunar_callback' );