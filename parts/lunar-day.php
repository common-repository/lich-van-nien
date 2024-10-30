<?php
$lunar_data  = get_query_var( 'lunar' );
$lunar       = $lunar_data['lunar'];
$dd          = $lunar_data['day'];
$mm          = $lunar_data['month'];
$yy          = $lunar_data['year'];
$lunar_date  = $lunar->get_lunar_date( $dd, $mm, $yy );
$day_of_week = $lunar->week[ ( $lunar_date->jd + 1 ) % 7 ];
$day_name    = $lunar->get_day_name( $lunar_date );
?>
<h5 class="month-of-year"><?php echo __( "Tháng $mm năm $yy", 'calendar-lunar' ) ?></h5>
<div class="day"><?php echo $dd; ?></div>
<div class="hoangdao">
	<?php echo __( 'Giờ hoàng đạo: ', 'calendar-lunar' ) . $lunar->get_hours_zodiac( $lunar_date->jd ); ?>
</div>
<div class="calendar-lunar">
    <div class="col-left">
        <h5 class="title month-of-year"><?php echo $day_of_week ?></h5>
        <div class="description"><?php echo $day_name ?></div>
    </div>
    <div class="col-right">
        <h5 class="title month-of-year">Lịch âm</h5><div class="day"><?php echo $lunar_date->day > 9 ? $lunar_date->day : '0' . $lunar_date->day; ?></div>
        <div class="description"><?php echo __( 'Tháng ', 'calendar-lunar' ); echo $lunar_date->month > 9 ? $lunar_date->month : '0' . $lunar_date->month; ?></div>
    </div>
    <div class="clear"></div>
</div>