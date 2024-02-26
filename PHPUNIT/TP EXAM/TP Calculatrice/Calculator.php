<?php

class Calculator {
    public function add($a, $b) {
        return $a + $b;
    }

    public function subtract($a, $b) {
        return $a - $b;
    }

    public function multiply($a, $b) {
        return $a * $b;
    }

    public function divide($a, $b) {
        if ($b == 0) {
            throw new Exception("Division par zéro impossible.");
        }
        return $a / $b;
    }

    public function square($a) {
        return $a * $a;
    }
}

?>
