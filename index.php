<?php
if (isset($_POST['ADD'])){
addFun($_POST['X'],$_POST['Y']);
}
function addFun($x,$y){
$s=$x+$y;
echo "The sum of $x + $y = ".$s;
}
?>
<form method="post" action="">
<B>UserName</B> <input name = "X" type=“text"/>
<B>Value 2</B> <input name = "Y" type=“text"/>
<p> <input name = "ADD" type="submit" value="ADD" /> 
<input type="Reset" value="rest" /> </p>
</form>
