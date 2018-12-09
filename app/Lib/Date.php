<?php 
namespace App\Lib;

class Date
{
	public static function date2Text($date)
    {
        $week = array('Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bảy', 'Chủ nhật');
        $month = array('Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12');
        $key_week = date('w', strtotime($date));
        $key_month = date('m', strtotime($date));
        return $week[$key_week]. ', ngày '. date('d', strtotime($date)). ' '.$month[$key_month - 1];
    }
    // App\Lib\Date::time2Text($time, '%02d giờ %02d phút')
    public static function time2Text($time, $format = '%02d:%02d') {
	    if ($time < 1) {
	        return;
	    }
	    $hours = floor($time / 60);
	    $minutes = ($time % 60);
	    return sprintf($format, $hours, $minutes);
	}

}
