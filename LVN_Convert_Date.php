<?php
/**
 * Created by PhpStorm.
 * User: datcx
 * Date: 2020-04-29
 * Time: 10:38
 */
require 'LVN_Lunar_Date.php';
class LVN_Convert_Date
{
    function int($d) {
        return floor($d);
    }

    function jd_from_date($dd, $mm, $yy) {
        $a = $this->int((14 - $mm) / 12);
        $y = $yy + 4800 - $a;
        $m = $mm + 12 * $a - 3;
        $jd = $dd + $this->int((153 * $m + 2) / 5) + 365 * $y + $this->int($y / 4) - $this->int($y / 100) + $this->int($y / 400) - 32045;
        if ($jd < 2299161) {
            $jd = $dd + $this->int((153* $m + 2)/5) + 365 * $y + $this->int($y / 4) - 32083;
        }
        return $jd;
    }

    function jd_to_date($jd) {
        if ($jd > 2299160) { // After 5/10/1582, Gregorian calendar
            $a = $jd + 32044;
            $b = $this->int((4*$a+3)/146097);
            $c = $a - $this->int(($b*146097)/4);
        } else {
            $b = 0;
            $c = $jd + 32082;
        }
        $d = $this->int((4*$c+3)/1461);
        $e = $c - $this->int((1461*$d)/4);
        $m = $this->int((5*$e+2)/153);
        $day = $e - $this->int((153*$m+2)/5) + 1;
        $month = $m + 3 - 12*$this->int($m/10);
        $year = $b*100 + $d - 4800 + $this->int($m/10);
        //echo "day = $day, month = $month, year = $year\n";
        return new LVN_Lunar_Date($day,$month,$year,$e,$jd);
    }

    function get_new_moon_day($k, $timeZone=7.0) {
        $T = $k/1236.85; // Time in Julian centuries from 1900 January 0.5
        $T2 = $T * $T;
        $T3 = $T2 * $T;
        $dr = M_PI/180;
        $Jd1 = 2415020.75933 + 29.53058868*$k + 0.0001178*$T2 - 0.000000155*$T3;
        $Jd1 = $Jd1 + 0.00033*sin((166.56 + 132.87*$T - 0.009173*$T2)*$dr); // Mean new moon
        $M = 359.2242 + 29.10535608*$k - 0.0000333*$T2 - 0.00000347*$T3; // Sun's mean anomaly
        $Mpr = 306.0253 + 385.81691806*$k + 0.0107306*$T2 + 0.00001236*$T3; // Moon's mean anomaly
        $F = 21.2964 + 390.67050646*$k - 0.0016528*$T2 - 0.00000239*$T3; // Moon's argument of latitude
        $C1=(0.1734 - 0.000393*$T)*sin($M*$dr) + 0.0021*sin(2*$dr*$M);
        $C1 = $C1 - 0.4068*sin($Mpr*$dr) + 0.0161*sin($dr*2*$Mpr);
        $C1 = $C1 - 0.0004*sin($dr*3*$Mpr);
        $C1 = $C1 + 0.0104*sin($dr*2*$F) - 0.0051*sin($dr*($M+$Mpr));
        $C1 = $C1 - 0.0074*sin($dr*($M-$Mpr)) + 0.0004*sin($dr*(2*$F+$M));
        $C1 = $C1 - 0.0004*sin($dr*(2*$F-$M)) - 0.0006*sin($dr*(2*$F+$Mpr));
        $C1 = $C1 + 0.0010*sin($dr*(2*$F-$Mpr)) + 0.0005*sin($dr*(2*$Mpr+$M));
        if ($T < -11) {
            $deltat= 0.001 + 0.000839*$T + 0.0002261*$T2 - 0.00000845*$T3 - 0.000000081*$T*$T3;
        } else {
            $deltat= -0.000278 + 0.000265*$T + 0.000262*$T2;
        };
        $JdNew = $Jd1 + $C1 - $deltat;
        //echo "JdNew = $JdNew\n";
        return $this->int($JdNew + 0.5 + $timeZone/24);
    }

    function get_sun_longitude($jdn, $timeZone = 7.0) {
        $T = ($jdn - 2451545.5 - $timeZone/24) / 36525; // Time in Julian centuries from 2000-01-01 12:00:00 GMT
        $T2 = $T * $T;
        $dr = M_PI/180; // degree to radian
        $M = 357.52910 + 35999.05030*$T - 0.0001559*$T2 - 0.00000048*$T*$T2; // mean anomaly, degree
        $L0 = 280.46645 + 36000.76983*$T + 0.0003032*$T2; // mean longitude, degree
        $DL = (1.914600 - 0.004817*$T - 0.000014*$T2)*sin($dr*$M);
        $DL = $DL + (0.019993 - 0.000101*$T)*sin($dr*2*$M) + 0.000290*sin($dr*3*$M);
        $L = $L0 + $DL; // true longitude, degree
        //echo "\ndr = $dr, M = $M, T = $T, DL = $DL, L = $L, L0 = $L0\n";
        // obtain apparent longitude by correcting for nutation and aberration
        $omega = 125.04 - 1934.136 * $T;
        $L = $L - 0.00569 - 0.00478 * sin($omega * $dr);
        $L = $L*$dr;
        $L = $L - M_PI*2*($this->int($L/(M_PI*2))); // Normalize to (0, 2*PI)
        return $this->int($L/M_PI*6);
    }

    function get_luna_month_11($yy, $timeZone = 7.0) {
        $off = $this->jd_from_date(31, 12, $yy) - 2415021;
        $k = $this->int($off / 29.530588853);
        $nm = $this->get_new_moon_day($k, $timeZone);
        $sunLong = $this->get_sun_longitude($nm, $timeZone); // sun longitude at local midnight
        if ($sunLong >= 9) {
            $nm = $this->get_new_moon_day($k-1, $timeZone);
        }
        return $nm;
    }

    function get_leap_month_offset($a11, $timeZone = 7.0) {
        $k = $this->int(($a11 - 2415021.076998695) / 29.530588853 + 0.5);
        $last = 0;
        $i = 1; // We start with the month following lunar month 11
        $arc = $this->get_sun_longitude($this->get_new_moon_day($k + $i, $timeZone), $timeZone);
        do {
            $last = $arc;
            $i = $i + 1;
            $arc = $this->get_sun_longitude($this->get_new_moon_day($k + $i, $timeZone), $timeZone);
        } while ($arc != $last && $i < 14);
        return $i - 1;
    }

    /* Comvert solar date dd/mm/yyyy to the corresponding lunar date */
    function convert_solar_to_lunar($dd, $mm, $yy, $timeZone = 7.0) {
        $dayNumber = $this->jd_from_date($dd, $mm, $yy);
        $k = $this->int(($dayNumber - 2415021.076998695) / 29.530588853);
        $monthStart = $this->get_new_moon_day($k+1, $timeZone);
        if ($monthStart > $dayNumber) {
            $monthStart = $this->get_new_moon_day($k, $timeZone);
        }
        $a11 = $this->get_luna_month_11($yy, $timeZone);
        $b11 = $a11;
        if ($a11 >= $monthStart) {
            $lunarYear = $yy;
            $a11 = $this->get_luna_month_11($yy-1, $timeZone);
        } else {
            $lunarYear = $yy+1;
            $b11 = $this->get_luna_month_11($yy+1, $timeZone);
        }
        $lunarDay = $dayNumber - $monthStart + 1;
        $diff = $this->int(($monthStart - $a11)/29);
        $lunarLeap = 0;
        $lunarMonth = $diff + 11;
        if ($b11 - $a11 > 365) {
            $leapMonthDiff = $this->get_leap_month_offset($a11, $timeZone = 7.0);
            if ($diff >= $leapMonthDiff) {
                $lunarMonth = $diff + 10;
                if ($diff == $leapMonthDiff) {
                    $lunarLeap = 1;
                }
            }
        }
        if ($lunarMonth > 12) {
            $lunarMonth = $lunarMonth - 12;
        }
        if ($lunarMonth >= 11 && $diff < 4) {
            $lunarYear -= 1;
        }
       return new LVN_Lunar_Date( $lunarDay, $lunarMonth, $lunarYear, $lunarLeap, $dayNumber );
    }

    /* Convert a lunar date to the corresponding solar date */
    function convert_lunar_to_solar($lunarDay, $lunarMonth, $lunarYear, $lunarLeap, $timeZone = 7.0) {
        if ($lunarMonth < 11) {
            $a11 = $this->get_luna_month_11($lunarYear-1, $timeZone);
            $b11 = $this->get_luna_month_11($lunarYear, $timeZone);
        } else {
            $a11 = $this->get_luna_month_11($lunarYear, $timeZone);
            $b11 = $this->get_luna_month_11($lunarYear+1, $timeZone);
        }
        $k = $this->int(0.5 + ($a11 - 2415021.076998695) / 29.530588853);
        $off = $lunarMonth - 11;
        if ($off < 0) {
            $off += 12;
        }
        if ($b11 - $a11 > 365) {
            $leapOff = $this->get_leap_month_offset($a11, $timeZone);
            $leapMonth = $leapOff - 2;
            if ($leapMonth < 0) {
                $leapMonth += 12;
            }
            if ($lunarLeap != 0 && $lunarMonth != $leapMonth) {
                return array(0, 0, 0);
            } else if ($lunarLeap != 0 || $off >= $leapOff) {
                $off += 1;
            }
        }
        $monthStart = $this->get_new_moon_day($k + $off, $timeZone);
        return $this->jd_to_date($monthStart + $lunarDay - 1);
    }
}