<?php

/*
* dateTime - snippet: operate with date 
* 
* usage: [!dateTime? &date=`[+date+]` &date2=`now` &format=`Y-m-d` &lng=`ru`!]
*
* params:
    @date
    @date2
    @format
    @lng
    @locPath
*
* return: formated date
*/


// SNIPPET SETTINGS //

$date = isset($date) ? trim($date) : 'NOW';
$date2 = isset($date2) ? trim($date2) : false;
$format = isset($format) ? trim($format) : 'Y-m-d';
$lng = isset($lng) ? trim($lng) : 'ru';
$locPath = isset($path) ? trim($path) : 'assets/snippets/dateTime/lng/';


// склоненеие окончаний
if(!function_exists('declOfNum')) {

    function declOfNum($number, $titles)  
    {  
        if($number == 0) return;

        $cases = array(2, 0, 1, 1, 1, 2);  
        return $number . " " . $titles[ ($number%100>4 && $number%100<20)? 2 : $cases[($number%10<5)?$number%10:5] ];  
    } 

}


// START SNIPPET //

$lngFile = trim(MODX_BASE_PATH .  "/") . "/" . $locPath . $lng . ".json";

// read local lang file
if(is_readable($lngFile)) {
    
    $translate = file_get_contents($lngFile);

    $translate = json_decode($translate, true);
    
} else {

    return "Ошибка при чтении языкового файла";

}

// init $date
if(is_numeric($date) && strlen($date) == 10) {
    $dateStart = dateTime::createFromFormat('U', $date);        
} else {
    $dateStart = new dateTime($date);        
}


if($date2) {

    if(is_numeric($date2) && strlen($date2) == 10) {
        $dateEnd = dateTime::createFromFormat('U', $date2);        
    } else {
        $dateEnd = new dateTime($date2);        
    }

    $diffArr = $dateStart->diff($dateEnd); // ['y', 'm', 'd', 'h', 'i', 's', 'days']

    $out = declOfNum($diffArr->y, $translate['y']) . " " .  declOfNum($diffArr->m, $translate['m']) . " " . declOfNum($diffArr->d, $translate['d']);

} else {

    if( ( strpos($format, 'M') !== false ) && ( $lng == 'ua' ) ) { $translate['May'] = 'Трав'; } // transform to UA month local name 
    
    $out = ($lng != 'en') ? str_ireplace(array_keys($translate), array_values($translate), $dateStart->format($format)) : $dateStart->format($format);

}

return $out;

?>