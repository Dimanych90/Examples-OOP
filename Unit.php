<?php


abstract class Unit
{
    public $health = 10;
    public $speed = 100;
    public $name;

    public function __construct($carName)
    {
        echo 'hello I am' . ' ' . $this->name = $carName;
    }

    abstract function health();

    public function move()
    {
      echo  $this->speed = $this->speed * 2;
    }
}

Class Tayota extends Unit
{

    function health()
    {
        echo 'My health is ' . $this->health;
    }

    public function move()
    {
        echo $this->speed = $this->speed * 2;
    }
}

Class Bmw extends Unit
{
    public function __construct($carName)
    {
        parent::__construct($carName);
    }

    public function move()
    {
        parent::move();
        echo ' and max ';
        parent::move();
    }

   function health()
    {
       echo ' My health is '. $this->health;
    }
}

$tayota = new Tayota('Tayota');

echo '<br> And my speed is ';

$tayota->move();
echo '<br>';
$tayota->health();
echo '<br>';

$bmw = new Bmw('BMW');
echo '<br> And my speed is ';
$bmw->move();
echo '<br>';
$bmw->health();


