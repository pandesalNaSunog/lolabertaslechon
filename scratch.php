<?php
    // $exampleProducts = array("toyo","mantika","asin","suka","magic Sarap");
    // $exampleQuantity = array(1,2,3,4,5,6);
    // foreach($exampleProducts as $product && $exampleQuantity as $quantity){
    //     echo "product: " . $product . "---" . $quantity . "<br>";;
    // }
$first_loop = array('75', '79', '32', '10');
$second_loop = array('1', '3', '2', '4');

$str = "";
foreach(array_combine($first_loop, $second_loop) as $a => $b){
    $str .= "$a**$b****";
}
echo $str
?>