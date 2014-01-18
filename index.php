<?php
//session_start();
require_once('autoload.php');
session_start();

?>
<!DOCTYPE>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css"/>
</head>
<body>
<div id="wrapper">
<div id="main">
<table>
<form method="post" action="SearchText.php">
<tr>
<th colspan=3>
<div id="thead"><h2>Search It</h2></div>
</th>
</tr>
<tr>
<td colspan=3>
<input type="text" id="stext" name="stext" placeholder="enter your search text"/>
</td>
</tr>
<tr>
<td>
<input type="submit" id="search" name="search" value="Search"/>
</td>
<td>
<input type="submit" id="related" name="related" value="Lucky"/>
</td>
<td>
<input type="submit" id="suggested" name="suggested" value="Synonymous"/>
</td>
</tr>
</form>
</table>
<div id="suggestions">
<?php
if(isset($_SESSION['suggs']) && !empty($_SESSION['suggs'])){
	print_r("<h4><i>Suggestions</i></h4>");
	$words=$_SESSION['suggs'];
	foreach($words as $word){
		print_r("<span>".$word."</span>");
	}
}
?>
</div>
</div>
<div id="right">
<table>
<tr>
<th colspan=2>
<h3>The Word Histogram</h3>
</tr>
<?php
$res=(new ShowWords())->sortbyMostSearched();
foreach($res as $words){
	print_r('<tr>');
	foreach($words as $word){
		print_r('<td>'.$word."</td>");
	}
	print_r("</tr>");
}
?>
</table>
</div>

</div>
</body>
</html>

