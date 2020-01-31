<?php
function validColor($color) {
    global $f3;
    return in_array($color, $f3 -> get('colors'));
}
//function validString($string) {
//    global $f3;
//    return in_array($string, $f3 -> get('animalName'));
//}