<!DOCTYPE HTML5>
<HTML>
<head>
<title> Calendar </title>
<meta charset="UTF-8">
<style>
td {
	border : 1px solid black;
	padding:5px;
}
table {
	border-collapse :  collapse;
}
a {
	text-decoration:none;
}
table {
	margin-right: auto;
    margin-left: auto;	
}
#calendar 
{
	text-align:center; 
}
</style>
</head>
<body>
<?php 
function getDates(&$year,&$month)
{
	$year = str_replace(",",".",$year);
	$month = str_replace(",",".",$month);
	if( 
	    ( (!isset($year)) or (!isset($month)) ) ||
	    ( (empty($year)) or (empty($month)) ) ||
	    ( (!is_numeric($month)) or (!is_numeric($year)) ) || 
	    ( ($year < 0) or ($month < 0) ) ||
		( ($month > 12) or ($month < 1) or ($year < 0) )
	  ) 
	{
		$month = date("m");
		$year = date("Y");
		$date = strtotime($year."-".$month);
		return($date);
	} 
	else
	{
		$date = strtotime((integer)$year."-".(integer)$month);
        return($date);
	}
}
function calendar( $year = "",$month = "" ){
	$date = getDates($year,$month);
	#-----------------------------------------------Вывод стрелочек
	$result .='<div id="calendar"><bold><h2><a href="http://work.freesa.ru/file.php?year=';
	if($month > 1)    $result .= $year.'&month='.($month - 1).'">< </a>';
	        else $result .=($year - 1).'&month=12">< </a>';
	$monthName = date(" F ",$date);
	$result .= $monthName ;
	$result .='<a href="http://work.freesa.ru/file.php?year=';
	if($month < 12)    $result .=$year.'&month='.($month + 1).'">> </a>';
	        else $result .=($year + 1).'&month=1">> </a>';
			
    $result .='<a href="http://work.freesa.ru/file.php?year='.($year - 1).'&month='.$month.'">< </a>';
	$result .= $year;
	$result .='<a href="http://work.freesa.ru/file.php?year='.($year + 1).'&month='.$month.'">> </a>';
	$result .="</h2></bold>";
	#-------------------------------------------------Вывод таблицы
    $result .= "
    <table>
	<tr>
    ";
	$days = array("monday","tuesday","wednesday","thursday","friday","saturday","sunday");
	for($i = 0;$i < count($days);$i++)
	{
	    $result .= "<td>" . $days[$i] . "</td>" . "\r\n";
	}
	$result .= "</tr>\r\n";
	$result .= "<tr>\r\n";	
	$c = 1;
	$w = date("w",$date);
	if($w == 0) $w =  7;
	for($i = 1;$i < date("t",$date) + $w;$i++)
	{
		if($c <= date("t",$date) and ($i >= $w)) {
			$result .= "<td>" . $c . "</td>\r\n";
	     	$c++;
		}	else $result .= "<td><pre>  </pre></td>\r\n"; 
     		
		if($i % 7 == 0) $result .= "</tr>\r\n";
		if(($i != 35) && ($i % 7 == 0)) $result .= "<tr>\r\n";	
	}
	$result .= "</table></div>";
	return($result);
}
echo(calendar($_GET["year"],$_GET["month"]));


    
?>
</body>
</html>
