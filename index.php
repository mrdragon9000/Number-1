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
</style>
<?php 
function calendar( $year = "",$month = "" ){
		if(($year == null) or ($month == null)) {$month = date("m",time());
		$year = date("Y",time()); }

	if(($year > 0) and ($month > 0)){$year = (integer)$year;
	$month = (integer)$month;}
	$year = preg_replace("/^0{2,}/","",$year);
	$month = preg_replace("/^0{2,}/","",$month);
    $date = (($year == "") and ($month == "")) ? time() : strtotime((integer)$year."-".(integer)$month); 
	if(isset($year) and isset($month))
		if(($month > 12) or ($month < 1) or ($year < 0) or (is_float($year + $month)) or (!is_numeric($year)) or (!is_numeric($month))) {echo("<center><h1> Введён не верный месяц или год</h1></center>");  return(false);}
	
	#-----------------------------------------------
	echo('<bold><center><h2> <a href="http://work.freesa.ru/file.php?year=');
	if($month > 1)    echo($year.'&month='.($month - 1).'">< </a>');
	        else echo(($year - 1).'&month=12">< </a>');
	$monthName = date(" F ",$date);
	echo( $monthName );
	echo('<a href="http://work.freesa.ru/file.php?year=');
	if($month < 12)    echo($year.'&month='.($month + 1).'">> </a>');
	        else echo(($year + 1).'&month=1">> </a>');
			
    echo('<a href="http://work.freesa.ru/file.php?year='.($year - 1).'&month='.$month.'">< </a>');
	echo($year);
	echo('<a href="http://work.freesa.ru/file.php?year='.($year + 1).'&month='.$month.'">> </a>');
	echo("</h2><center></bold>");
    $result = "
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
	$result .= "</table></center>";
	return($result);
}
echo(calendar($_GET["year"],$_GET["month"]));

?>