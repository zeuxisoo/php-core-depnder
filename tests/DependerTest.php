<?php
use Zeuxisoo\Core\Depender;

class DependerTest extends PHPUnit_Framework_TestCase {

    public function testInstance() {
        $this->assertInstanceOf('\\Zeuxisoo\\Core\\Depender', new Depender);
    }

    public function testAssignValueFromClassProperty() {
        $depender = new Depender();
        $depender->text1 = '1234';

        $this->assertEquals('1234', $depender->text1);
        $this->assertEquals('1234', $depender->get('text1'));
    }

    public function testAssignValueFromSetMethod() {
        $depender = new Depender();
        $depender->set('text1', '1234');

        $this->assertEquals('1234', $depender->text1);
        $this->assertEquals('1234', $depender->get('text1'));
    }

    public function testAssignClosure() {
        $depender = new Depender();
        $depender->func = function() {
            return "1234";
        };

        $func_a = $depender->get('func');
        $func_b = $depender->func;

        $this->assertInstanceOf('\Closure', $func_a);
        $this->assertInstanceOf('\Closure', $func_b);
        $this->assertEquals('1234', $func_a());
        $this->assertEquals('1234', $func_b());
    }

    public function testActValue() {
        $depender = new Depender();
        $depender->text1 = '1234';
        $depender->text2 = 'abcd';

        $this->assertEquals('1234', $depender->act('text1'));
        $this->assertEquals('abcd', $depender->act('text2'));
    }

    public function testActClosure() {
        $depender = new Depender();
        $depender->text1 = '1234';
        $depender->text2 = 'abcd';
        $depender->func1 = function() {
            return "!@#$";
        };

        $result = $depender->act(function($text1, $text2, $func1, $none) {
            return array($text1, $text2, $func1, $none);
        });

        $func1_old = $depender->func1;
        $func1_new = $result[2];

        $this->assertInternalType('array', $result);
        $this->assertEquals($depender->text1, $result[0]);
        $this->assertEquals($depender->text2, $result[1]);
        $this->assertEquals($depender->func1, $result[2]);
        $this->assertEquals($func1_old(), $func1_new());
        $this->assertNull($result[3]);
    }

    public function testDelValue() {
        $depender = new Depender();
        $depender->text1 = '1234';
        $depender->text2 = 'abcd';

        $depender->del('text1');

        $this->assertFalse(property_exists($depender, 'text1'));
        $this->assertFalse(property_exists($depender, 'text1'));

        $this->assertEquals('abcd', $depender->text2);
        $this->assertEquals('abcd', $depender->get('text2'));
    }
}
