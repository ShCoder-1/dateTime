//<?php
/**
* dateTime
* 
* Вывод даты с разной локализаций, форматирование дат, вычисление разницы между датами
*
* usage: 
*    [!dateTime? &date=`NOW` &date2=`[+date+]` &lng=`ua`!] // show diff 
*    [!dateTime? &date=`[*createdon*]` &format=`D, d m Y` &lng=`ru`!] // Пон, 21 января 2011
*
* @author      ShCoder - sitemart@gmail.com
*
* @category    snippet
* @version     0.2
* @license     http://www.gnu.org/copyleft/gpl.html GNU Public License (GPL)
* @internal    @properties 
* @internal    @modx_category add
* @internal    @installset base, sample
 */

return require MODX_BASE_PATH.'assets/snippets/dateTime/dateTime.php';
