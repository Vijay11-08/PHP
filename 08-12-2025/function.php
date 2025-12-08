<h1>Functions in PHP</h1>

<li>Function is a block of code that can be reused to perform a specific task.</li>
<li>Functions help you to organize your code into logical sections and avoid repetition.</li>
<li>The real power of PHP comes from its functions;</li>
<li>It has more than 1000 built-in functions.</li>
<li>A user-defined function declaration starts with the word function.</li>


<br>
<!-- Simple Function -->
<h2>Simple Function</h2>
<?php
function writeMsg(  ) //definition
{
    echo "Hello world!";
}
writeMsg( ) ;        // call the function
?>

<!-- Function Arguments -->
<h2>Function Arguments</h2>
<?php
function familyName($fname, $year) //formal args
{
    echo "$fname Born in $year <br>";
}
familyName("Heet", "2005"); //actual args
familyName("Sila", "2008");
familyName("Jimy", "2010");
?>

<!-- Default Argument Value -->
<h2>Default Argument Value</h2>
<?php

function setHeight($minheight = 50)
{
    echo "The height is : $minheight <br>";
}
setHeight(350);
setHeight( ); // will use the default value of 50
setHeight(135);
setHeight(80);

?>

<!-- Return Values -->
<h2>Return Values</h2>
<?php

function sum($x,$y){
        $z = $x + $y;
        return $z;
}
echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4);

?>