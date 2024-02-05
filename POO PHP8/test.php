<?php

class Person {
    private $name;
    private $age;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
    }

    public function getName() {
        return $this->name;
    }

    public function getAge() {
        return $this->age;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setAge($age) {
        $this->age = $age;
    }
}

class Employee extends Person {
    private $salary;

    public function __construct($name, $age, $salary) {
        parent::__construct($name, $age);
        $this->salary = $salary;
    }

    public function getSalary() {
        return $this->salary;
    }

    public function setSalary($salary) {
        $this->salary = $salary;
    }
}

// Utilisation des classes
$person = new Person("John Doe", 30);
echo $person->getName() . "\n"; // Affiche "John Doe"

$employee = new Employee("Jane Doe", 35, 50000);
echo $employee->getName() . "\n"; // Affiche "Jane Doe"
echo $employee->getSalary() . "\n"; // Affiche 50000

$person1 = new Person("Alice", 25);
echo $person1->getName() . "\n"; // Affiche "Alice"

$employee1 = new Employee("Bob", 40, 60000);
echo $employee1->getName() . "\n"; // Affiche "Bob"
echo $employee1->getSalary() . "\n"; // Affiche 60000

$person2 = new Person("Charlie", 50);
echo $person2->getName() . "\n"; // Affiche "Charlie"

$employee2 = new Employee("Dave", 55, 70000);
echo $employee2->getName() . "\n"; // Affiche "Dave"
echo $employee2->getSalary() . "\n"; // Affiche 70000

// Utilisation des setters
$person1->setName("Updated Alice");
echo $person1->getName() . "\n"; // Affiche "Updated Alice"

$employee1->setSalary(65000);
echo $employee1->getSalary() . "\n"; // Affiche 65000

?>