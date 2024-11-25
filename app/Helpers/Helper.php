<?php 
function numberFormat($num){
    return sprintf('%0.2f',$num);
}

function getIndianCurrency(float $number){
    $negative = false;
    if($number < 0){
        $negative = true;
        $number = abs($number);
    }
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? " Point " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) : '';
    $amount =  ($Rupees ? $Rupees : '') . $paise . ' '.getCurrencySymbol(true);
    if($negative){
        $amount = '(Minus) '. $amount;
    }
    return $amount;
}

function genRandomValue($length=5,$type='digit',$prefix=null){
    if($type=='digit'){
        $characters = date('Ymd').'123456789987654321564738291918273645953435764423'.time();
    } else {
        $characters = date('Ymd').'192837465TransactionRandomId987654321AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz111xxxBheemSwamixxx9OO14568O8xxxBikanerRajasthan34OO1'.time();
    }
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $prefix.$randomString;
}

function getNextPrevDate($isDate='prev', $days=null){
    if($isDate=='prev'){
        $symbol = '-';
    } else {
        $symbol = '+';
    }
    if($days==null){
        $days = getSettings('default_rec_days');
    }
    return date('Y-m-d', strtotime(date('Y-m-d'). $symbol.$days.' days'));
}

function addSubDate($isDate, $val, $date, $format='d-m-Y', $adsSub='days'){
    //$isDate: +,- | $val: numericVal | $adsSub: days, months, year
    return date($format, strtotime($date. $isDate.$val.' '.$adsSub));
}

function timeAgo($date) {
   $timestamp = strtotime($date);   
   
   $strTime = ["second", "minute", "hour", "day", "month", "year"];
   $length = ["60","60","24","30","12","10"];

   $currentTime = time();
   if($currentTime >= $timestamp) {
        $diff     = time()- $timestamp;
        for($i = 0; $diff >= $length[$i] && $i < count($length)-1; $i++) {
            $diff = $diff / $length[$i];
        }

        $diff = round($diff);
        if($diff < 10){
            return dateConvert($date, 'Y-m-d h:i');
        }
        return $diff . " " . $strTime[$i] . "(s) ago ";
   }
}
function dateConvert($date=null,$format=null){
    if($date==null)
        return date($format);
    if($format==null)
        return date('Y-m-d',strtotime($date));
    else 
        return date($format,strtotime($date));
}

function dateDiff($sDate, $eDate, $format = 'days'){
    $date1=date_create($sDate);
    $date2=date_create($eDate);
    $diff=date_diff($date1,$date2);
    if($format == 'days') {
        return $diff->format("%a");
    }
    return $diff->format("%R%a"); // if daysWIthSymbol
}

function dateRange($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
}

function timeConvert($time,$format=null){
    if($format==null)
        return date('H:i:s',strtotime($time));
    else 
        return date($format,strtotime($time));
}

function timeFormatAmPm($time=null){
    if($time==null || $time==''){
        return '';
    }
    $exp = explode(' ', $time);
    $temp = date_parse($exp[0]);
    $temp['minute'] = str_pad($temp['minute'], 2, '0', STR_PAD_LEFT);
    return date('h:i a', strtotime($temp['hour'] . ':' . $temp['minute']));
}

function splitText($string=null, $splitBy = ','){
    if($string==null || $string==''){
        return [];
    }
    return explode($splitBy, $string);
}

function limit_text($text, $limit) {
  if (strlen($text) > $limit) {
        $text = substr($text, 0, $limit) . '...';
  }
  return $text;
}

function limit_words($string, $word_limit) {
    if (str_word_count($string, 0) > $word_limit) {
        $words = explode(" ",$string);
        return implode(" ",array_splice($words,0,$word_limit)).'...';
    }
    return $string;
}