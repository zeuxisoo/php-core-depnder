<?php
require_once dirname(dirname(__FILE__))."/vendor/autoload.php";

// Namespace
use Zeuxisoo\Core\Depender;

// Helper
$label = function($name) { echo "#### $name\n"; };

// Initial
$depender = new Depender();

// Assign
$depender->text1 = '1234';
$depender->text2 = 'abcd';
$depender->func1 = function($message) {
    echo $message;
};

// Run act case 1
$label("Case 1");
$depender->act(function($text1, $text2, $func1, $none) {
    echo $text1,"\n";
    echo $func1("This is a test message from func1\n");

    if ($none === null) {
        echo "It is null value\n";
    }
});

// Run act case 2
$label("Case 2");
$depender->act(function($text2, $func1, $text1, $none) {
    echo $text2,"\n";
    echo $func1("This is a test message from func1 too\n");

    if ($none === null) {
        echo "It is null value too\n";
    }
});

// Run act case 3
$label("Case 3");
$depender->act(function($text2) {
    echo "Only work for text2 ==> ",$text2,"\n";
});

// Run act case 4
$label("Case 4");
echo $depender->act(function($text2) {
    return "Is is return value text2 ==> $text2 \n";
});

// Run act case 5
$label("Case 5");
echo "Null value =>", $depender->act('text3');

// Delete value
$depender->del('text1');
unset($depender->text1);
