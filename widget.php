<?php
if ( ! class_exists( 'LVN_Widget_Lunar' ) ) {
	Class LVN_Widget_Lunar extends WP_Widget {
		function __construct() {
			parent::__construct(
				'widget_lunar',
				__( 'Lịch vạn niên', 'calendar-lunar' ),
				array( 'description' => 'Hiển thị lịch vạn niên...' )
			);
		}

		function widget( $args, $instance ) {
			$lunar = new LVN_Lunar();
			echo $args['before_widget'];
			echo $args['before_title'] . $instance['lunar_title'] . $args['after_title'];
			echo "<div class='lunar-widget'>";
			switch ( $instance['lunar_type'] ) {
				case 'month':
					$this->lunar_search();
					wp_nonce_field( 'lvn-find-month' );
					echo $lunar->print_month( date( 'm' ), date( 'Y' ) );
					break;
				case 'day':
					wp_nonce_field( 'lvn-find-day' );
					$this->show_day();
					break;
			}
			echo "</div>";

			echo $args['after_widget'];

		}

		function form( $instance ) {
			$lunar_info = array(
				'lunar_title' => __( 'Lịch vạn niên', 'calendar-lunar' )
			);
			$instance   = wp_parse_args( (array) $instance, $lunar_info );
			?>
            <p>
                <label for="<?php echo $this->get_field_id( 'lunar_title' ); ?>"><?php _e( 'Tiêu đề' ); ?></label>
                <br>
                <input class="widefat" id="<?php echo $this->get_field_id( 'lunar_title' ); ?>"
                       name="<?php echo $this->get_field_name( 'lunar_title' ); ?>" type="text"
                       value="<?php echo esc_attr( $instance['lunar_title'] ); ?>"/>

            </p>
            <p>
                <label for="<?php echo $this->get_field_id( 'lunar_type' ); ?>"><?php _e( 'Hiển thị' ); ?></label>
                <br>
                <select name="<?php echo $this->get_field_name( 'lunar_type' ); ?>">
                    <option <?php if ( $instance['lunar_type'] == 'month' )
						echo 'selected' ?> value="month">Tháng
                    </option>
                    <option <?php if ( $instance['lunar_type'] == 'day' )
						echo 'selected' ?> value="day">Ngày
                    </option>
                </select>
            </p>
			<?php
		}

		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;

			$instance['lunar_title'] = strip_tags( $new_instance['lunar_title'] );
			$instance['lunar_type']  = strip_tags( $new_instance['lunar_type'] );

			return $instance;
		}

		function lunar_search() {
			?>
            <div class="lunar-search">
                <select class="search-month lunar-search-item">
					<?php for ( $i = 1; $i <= 12; $i ++ ): ?>
                        <option value="<?php echo $i; ?>" <?php if ( $i == date( 'm' ) ) {
							echo 'selected';
						} ?>><?php echo $i ?></option>
					<?php endfor; ?>
                </select>
                <input type="number" class="search-year lunar-search-item" value="<?php echo date( 'Y' ) ?>"/>
                <button class="lunar-search-button lunar-search-item">Tìm</button>
            </div>
			<?php
		}

		public function show_day() {
			$lunar = new LVN_Lunar();
			?>
            <div class='calendar-day'>
            <div class="day-top">
                <a href="javascript:void(0)" class="lunar-prev"></a>
                <input value="<?php echo date( 'd-m-Y' ) ?>" class="lunar-find-day"/>
                <a href="javascript:void(0)" class="lunar-next"></a>
            </div>
            <div class="day-content">
			<?php
			$lunar_date = $lunar->print_day( date( 'd' ), date( 'm' ), date( 'Y' ) );
			echo $lunar_date;
			echo "</div>";
			echo "</div>";
		}
	}
}

if ( ! function_exists( 'lvn_register_widget_lunar' ) ) {
	function lvn_register_widget_lunar() {
		register_widget( 'LVN_Widget_Lunar' );
	}
}

add_action( 'widgets_init', 'lvn_register_widget_lunar' );