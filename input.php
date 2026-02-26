<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"/>
</head>
<body>
<!--
<pre>
<?php
 var_dump($_GET);
 var_dump($_POST);
 ?>
</pre>
-->
<?php
date_default_timezone_set('Asia/Tokyo');

$temp = $_GET['temp'] / 10;
print $temp;
// print $_GET['temp'] / 10;
echo "\n";
echo date('Y-m-d H:i:s');
 ?>
<br>
<?php
if ($temp < 30.0 or $temp > 40.0) {
   print "Are you sure?";
   echo "<br><a href=\"__HOMEDIR__\">back</a>";
} else {
   $fh = fopen("__OUTPUTDIR__/temp.csv", "a");
//   var_dump($fh);
   fputcsv($fh, [date('Y-m-d H:i:s'), $temp]);
   fclose($fh);
   $temp = 0.0;
 }
 ?>
</body>
</html>
