<?php
// testsFunctions.php

use PHPUnit\Framework\TestCase;

require_once 'functions.php';

class FunctionsTest extends TestCase {

    public function testInverserChaine() {
        $this->assertEquals('olleH', inverserChaine('Hello'));
        $this->assertEquals('abc123', inverserChaine('321cba'));
        $this->assertEquals('radar', inverserChaine('radar'));
        $this->assertEquals('', inverserChaine(''));
    }

    public function testEstPalindrome() {
        $this->assertTrue(estPalindrome('radar'));
        $this->assertTrue(estPalindrome('A man, a plan, a canal, Panama'));
        $this->assertFalse(estPalindrome('hello'));
        $this->assertFalse(estPalindrome('abc123'));
        $this->assertTrue(estPalindrome(''));
    }
}
?>