<?php
/*
Plugin Name: Lịch vạn niên
Plugin URI: http://caodatblog.com/lich-van-nien
Description: Plugin lịch vạn niên, lịch vạn sự, âm lịch
Author: Cao Dat
Version: 1.5
Author URI: http://caodatblog.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}// Exit if accessed directly

define( 'LVN_URL', plugin_dir_url( __FILE__ ) );
define( 'LVN_DIR', plugin_dir_path( __FILE__ ) );

// Load css

if ( ! function_exists( 'lvn_load_script' ) ) {
	function lvn_load_script() {
		wp_enqueue_style( 'lvn-custom', LVN_URL . 'assets/css/custom.css' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'lvn-custom', LVN_URL . 'assets/js/custom.js', '', '', true );
		wp_localize_script( 'lvn-custom', 'lvn_data', array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( - 1 )
		) );

	}

	add_action( 'wp_enqueue_scripts', 'lvn_load_script' );
}
require LVN_DIR. 'LVN_Convert_Date.php';
require LVN_DIR . 'LVN_Lunar_Date.php';
require LVN_DIR . 'LVN_Lunar.php';
require LVN_DIR . 'shortcode.php';
require LVN_DIR . 'widget.php';

if ( ! function_exists( 'lvn_find_month_callback' ) ) {
	function lvn_find_month_callback() {
		// Check sercurity
		check_ajax_referer( 'lvn-find-month', '_wp_nonce' );
		if ( isset( $_POST ) ) {
			$lunar_month = sanitize_text_field( $_POST['lunar_month'] );
			$lunar_year  = sanitize_text_field( $_POST['lunar_year'] );
			if ( $lunar_month < 1 || $lunar_month > 12 || $lunar_year < 1800 || $lunar_year > 2200 ) {
				$data = array(
					'code'    => 404,
					'message' => __( 'Dữ liệu không hợp lệ', 'calendar-lunar' )
				);
				echo json_encode( $data );
				die();
			} else {
				$lunar      = new LVN_Lunar();
				$ajax_nonce = wp_create_nonce( 'lvn-find-month' );
				$data       = array(
					'code'      => 200,
					'_wp_nonce' => $ajax_nonce,
					'content'   => esc_html( $lunar->print_month( $lunar_month, $lunar_year ) )
				);
				echo json_encode( $data );
				die();
			}
		}
		$data = array(
			'code'    => 401,
			'message' => __( 'Có lỗi xảy ra. Vui lòng thử lại!', 'calendar-lunar' )
		);
		echo json_encode( $data );
		die();
	}

	// Load lunar month ajax
	add_action( 'wp_ajax_lvn_find_month', 'lvn_find_month_callback' );
	add_action( 'wp_ajax_nopriv_lvn_find_month', 'lvn_find_month_callback' );
}

/* Ajax find day */
if ( ! function_exists( 'lvn_find_day_callback' ) ) {
	function lvn_find_day_callback() {
		// Check sercurity
		check_ajax_referer( 'lvn-find-day', '_wp_nonce' );
		if ( isset( $_POST ) ) {
			$lunar_date = sanitize_text_field( $_POST['lunar_date'] );
			$lunar_type = sanitize_text_field( $_POST['lunar_type'] );
			if ( lvn_validate_date( $lunar_date ) == false ) {
				$data = array(
					'code'    => 404,
					'message' => __( 'Dữ liệu không hợp lệ', 'calendar-lunar' )
				);
				echo json_encode( $data );
				die();
			} else {
				$lunar      = new LVN_Lunar();
				$ajax_nonce = wp_create_nonce( 'lvn-find-day' );
				$new_date   = date_create( $lunar_date );
				if ( $lunar_type == 'next' ) {
					$new_date = $new_date->modify( '+1 day' );
				} elseif($lunar_type == 'prev') {
					$new_date = $new_date->modify( '-1 day' );
				}

				$new_date     = $new_date->format( 'd-m-Y' );
				$new_date_arr = explode( '-', $new_date );
				$data         = array(
					'code'      => 200,
					'_wp_nonce' => $ajax_nonce,
					'content'   => esc_html( $lunar->print_day( $new_date_arr[0], $new_date_arr[1], $new_date_arr[2] ) ),
					'new_date'  => $new_date
				);
				echo json_encode( $data );
				die();
			}
		}
		$data = array(
			'code'    => 401,
			'message' => __( 'Có lỗi xảy ra. Vui lòng thử lại!', 'calendar-lunar' )
		);
		echo json_encode( $data );
		die();
	}

	// Load lunar month ajax
	add_action( 'wp_ajax_lvn_find_day', 'lvn_find_day_callback' );
	add_action( 'wp_ajax_nopriv_lvn_find_day', 'lvn_find_day_callback' );
}

if ( ! function_exists( 'lvn_validate_date' ) ) {
	function lvn_validate_date( $str ) {
		if ( preg_match( "/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $str ) ) {
			return true;
		} else {
			return false;
		}
	}
}
