<?php

namespace WowArmoryAPI;

class Utils {

	public function get_fuzzy_time( $timestamp ) {
		// values in microseconds
		$time_formats = array(
			array( 60000, 'justo ahora'),
			array( 90000, 'hace 1 minuto'),
			array( 3600000, 'minutos', 60000 ),
			array( 5400000, 'hace 1 hora'),
			array( 86400000, 'horas', 3600000 ),
			array( 129600000, 'hace 1 día'),
			array( 604800000, 'dias', 86400000 ),
			array( 907200000, 'hace 1 semana'),
			array( 2628000000, 'semanas', 604800000 ),
			array( 3942000000, 'hace 1 mes' ),
			array( 31536000000,'meses', 2628000000 ),
			array( 47304000000, 'hace un año' ),
			array( 3153600000000, 'años', 31536000000 ),
		);
		$now = time() * 1000; // current unix timestamp boosted to milliseconds
		// if a number is passed assume it is a unix time stamp
		// if string is passed try and parse it to unix time stamp
		if ( is_numeric( $timestamp ) ) {
			$dateFrom = $timestamp;
		} elseif ( is_string( $timestamp ) ) {
			$dateFrom = strtotime( $timestamp );
		}
		$difference = $now - $dateFrom; // difference between now and the passed time.
		$val        = ''; // value to return
		if ( $dateFrom <= 0 ) {
			$val = 'hace mucho tiempo';
		} else {
			// loop through each format measurement in array
			foreach ( $time_formats as $format ) {
				// if the difference from now and passed time is less than first option in format measurment
				if ( $difference < $format[0] ) {
					// if the format array item has no calculation value
					if ( count( $format ) == 2 ) {
						$val = $format[1];
						break;
					} else {
						// divide difference by format item value to get number of units
						$val = sprintf( '%d %s', ceil( $difference / $format[2] ), $format[1] );
						break;
					}
				}
			}
		}
		return $val;
	}
}
