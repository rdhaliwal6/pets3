<?php
session_start();

// turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require autoload file
require("vendor/autoload.php");
require_once('model/validation-functions.php');

// Instantiate F3
$f3 = Base::instance();
$f3 -> set('colors', array('pink', 'green', 'blue'));

//set debug level
$f3->set('DEBUG', 3);

// Define a default route
$f3->route('GET /', function () {
    echo "<h1> My Pets <br></h1>";
    echo "<a href='order'>Order a Pet</a>";
    //$views = new Template();
    //echo $views->render("views/home.html");
});

$f3->route('GET|POST /order', function($f3) {
    $_SESSION = array();
    if (isset($_POST['animalName'])) {
        $animal = $_POST['animalName'];
//        if (validString($animal)) {
//            $_SESSION['animal'] = $animal;
//            $f3 -> reroute('/order2');
//        } else {
//            $f3 -> set("errors['animal']", "Please enter an animal");
//        }
    }
    $view = new Template();
    echo $view->render('views/form1.html');
});

$f3->route('POST /order2', function() {
//    var_dump($_POST);
    $_SESSION['pets'] = $_POST['animalName'];
    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route('POST /results', function() {
//    var_dump($_POST);
    $_SESSION['pets2'] = $_POST['color'];
    $view = new Template();
    echo $view->render('views/results.html');
});

$f3->route('GET /@item', function($f3, $params){
    //var_dump($params);
    $item = $params['item'];

    switch($item) {
        case 'chicken':
            echo "<p>Cluck</p>";
            break;
        case 'dog':
            echo "<p>woof</p>";
            break;
        case 'horse':
            echo "<p>neigh</p>";
            break;
        case 'cat':
            echo "<p>meow</p>";
            break;
        case 'dino':
            echo "<p>rwar</p>";
            break;
        default:
            $f3->error(404);
    }
});
// Run F3
$f3->run();