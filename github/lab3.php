<!DOCTYPE html>
<html>
<head>
<style>
    .name {
    font-size: 30px;
    font-weight: bold;
    margin-bottom: 10px;
}

.courses{.highlighted {
    color: blue; 
}


</style>
</head>
<body>

<?php

$names = array("ahmad", "abas", "mohammad");
$arr_Length = count($names); //3
for ($x = 0; $x < $arr_Length; $x++) {
    echo "class mates " . $names[$x] . ".";
    echo "<br>";
}
echo "<br>";

$courses = array("cis101" => "programming1", "cis104" => "programming2", "swe322" => "advanced programming");
foreach ($courses as $x => $x_value) {
    echo "key = " . $x . "<br>". " courses = " . $x_value . ".";
    echo "<br>";
	
}
echo "<br>";


$Games = array(
    "Laptop" => array("Asus", "MSI"),
    "CPU" => array("AMD", "Intel"),
    "GPU" => array("AMD", "Nvidia")
);

echo "I am looking for a " . $Games['Laptop'][0] . " Laptop with " . $Games['CPU'][0] . " CPU and " . $Games['GPU'][1] . " GPU.";
?>






</body>
</html>