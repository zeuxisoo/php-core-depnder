### Status

[![Build Status](https://travis-ci.org/zeuxisoo/php-core-depnder.png?branch=master)](https://travis-ci.org/zeuxisoo/php-core-depnder)

### Installation

Install the composer

    curl -sS https://getcomposer.org/installer | php

Edit composer.json

    {
        "require": {
            "zeuxisoo/core-depender": "dev-master"
        }
    }

Install/update your dependencies

    php composer.phar install

### Usage

Load the depender library

    use Zeuxisoo\Core\Depender;

Example

    <?php
    use Zeuxisoo\Core\Depender;

    $depender = new Depender();

    $depender->text1 = '1234';
    $depender->text2 = 'abcd';
    $depender->text3 = '!@#$';
    $depender->func1 = function($message) {
        echo $message;
    };

    $depender->act(function($text1, $func1, $none) {
        echo $text1,"\n";
        echo $func1("This is a test message from func1\n");

        if ($none === null) {
            echo "It is null value\n";
        }
    });

    $depender->act(function($text2) {
        echo $text2,"\n";
    });

    echo $depender->act('text3');

    $depender->del('text1');
    unset($depender->text1);
