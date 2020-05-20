<?php

trait GPS
{

    public function withgps($min)
    {
        if ($min % 60 !== 0) {
            $hour = ceil($min / 60);
            $hour *= $this->moveGps;
            return $hour;
        } elseif ($min % 60 == 0) {
            $hour = $min / 60;
            $hour *= $this->moveGps;
            return $hour;
        }
    }
}

trait Add_driver
{
    public function withDriver()
    {
        echo ' С водителем + ' . $this->addDriver . ' рублей.';
    }
}

interface iTariff
{
    function move($km, $min);
}

abstract class Tarif implements iTariff
{
    protected $moveGps = 15;

    protected $addDriver = 100;

    public $pricekm;
    public $pricemin;


    function __construct($agedriver)
    {
        $this->age = $agedriver;
    }

    abstract function move($km, $min);


}

Class Base extends Tarif
{


    public $pricekm = 10;
    public $pricemin = 5;


    function __construct($agedriver)
    {
        parent::__construct($agedriver);
        if ($agedriver < 17) {
            echo 'Рано водить';
            die();
        } elseif ($agedriver >= 18 && $agedriver <= 21) {
            $this->pricekm = 11;
            $this->pricemin = 3.3;
            echo ' Тариф молодежный. ';
        } elseif ($agedriver > 21 && $agedriver <= 65) {
            $this->pricekm;
            $this->pricemin;
        } else {
            echo ' Невозможно рассчитать';
            die();
        }

    }


    public function move($km, $min)
    {
        $this->pricekm *= $km;
        $this->pricemin *= $min;
        $end = $this->pricekm + $this->pricemin;
//        $final = $end + $this->withgps($min);
        echo ' Вы проехали ' . $km . ' км ' . ' за ' . $min . ' мин ' . '.Итого выходит ' . $end . ' руб.';
//            ' плюс GPS: ' . $this->withgps($min) . ' рублей. Итого: ' . $final . ' рублей.';

    }

    use GPS;

}

Class An_hour extends Tarif
{
    use GPS;

    public $pricekm;
    public $pricemin = 200;

    function __construct($agedriver)
    {
        parent::__construct($agedriver);
        if ($agedriver < 17) {
            echo 'Рано водить';
            die();
        } elseif ($agedriver >= 18 && $agedriver <= 21) {
            $this->pricemin = 220;
            echo 'Тариф молодежный. ';
        } elseif ($agedriver >= 22 && $agedriver <= 65) {
            $this->pricemin;
        } else {
            echo ' Невозможно рассчитать ';
            die();
        }
    }

    function move($km, $min)
    {
        $hour = ceil($min / 60);

        if ($min % 60 !== 0) {

            $res = ceil($min / 60);
            $end = $res * $this->pricemin;
            echo ' Вы управляли автомобилем ' . $min . ' минут и это рассчитывется как ' . $hour . ' часов ' . '.Итого '
                . $end . ' руб. ';


        } elseif ($min % 60 == 0) {
            while ($min % 60 == 0) {
                $res = $min / 60;
                $end = $res * $this->pricemin;
                echo ' Вы управляли автомобилем ' . $min . ' минут и это рассчитывется как ' . $hour . ' часов ' . '.Итого '
                    . $end . ' руб.';

            }

        }
    }

    use Add_driver;

}

Class Day extends Tarif
{
    use GPS, Add_driver;
    public $pricekm = 1;
    public $pricemin = 1000;

    function __construct($agedriver)
    {
        parent::__construct($agedriver);
        if ($agedriver < 17) {
            echo ' Водить пока рано ';
        } elseif ($agedriver >= 18 && $agedriver <= 21) {
            $this->pricekm = 1.1;
            $this->pricemin = 1100;
            echo ' Тариф молодежный ';
        } elseif ($agedriver > 21 && $agedriver <= 65) {
            $this->pricekm;
            $this->pricemin;

        } else {
            echo ' Невозможно рассчитать ';
        }
    }

    function move($km, $min)
    {
        if ($min % 60 == 0) {
            $hours = $min / 60;
            $minute = $min % 60;
            echo $hours . ' часов ' . $minute . ' минут и ' . $km . ' километров <br>';
        } elseif ($min % 60 !== 0) {
            $hours = floor($min / 60);
            $minute = $min % 60;
            echo $hours . ' часов ' . $minute . ' минут и ' . $km . ' километров <br>';

        }
        if ($hours % 24 !== 0) {
            $day = ceil($hours / 24);
            $this->pricekm *= $km;
            $this->pricemin *= $day;
            $decision = $this->pricemin + $this->pricekm;
            echo 'Вы проездили ' . $day . ' суток ' . ' общая стоимость по тарифу: ' . $decision .
                ' рублей.';
        } elseif ($hours % 24 == 0) {
            $day = $hours / 24;
            $this->pricekm *= $km;
            $this->pricemin *= $day;
            $decision = $this->pricemin + $this->pricekm;
            echo 'Вы проездили ' . $day . ' суток ' . ' общая стоимость по тарифу: ' . $decision .
                ' рублей.';
        }


    }


}

Class Student extends Tarif
{
    use GPS;

    public $pricekm = 4;
    public $pricemin = 1;

    function __construct($agedriver)
    {
        parent::__construct($agedriver);
        if ($agedriver < 17) {
            echo ' Рано водить';
        } elseif ($agedriver >= 18 && $agedriver <= 21) {
            $this->pricekm = 4.4;
            $this->pricemin = 1.1;
            echo ' Тариф молодежный ';
        } elseif ($agedriver >= 22 && $agedriver <= 25) {
            $this->pricekm;
            $this->pricemin;
        } else {
            echo ' Невозможно рассчитать по этому тарифу';
        }
    }

    function move($km, $min)
    {
        $this->pricekm *= $km;
        $this->pricemin *= $min;
        $decision = $this->pricemin + $this->pricekm;
        echo ' Вы проехали ' . $km . ' км за ' . $min . ' минут, итого выходит ' . $decision .
            ' рублей.';
    }
}

$base = new Base('30');
$base->move(35, 65);
echo ' С GPS + ' . $base->withgps(185) . ' рублей.';

echo '<br>';

$an_hour = new An_hour('49');
$an_hour->move(0, 760);
echo ' С GPS +' . $an_hour->withgps(760) . ' рублей.';
$an_hour->withDriver();
echo '<br>';

$day = new Day('28');
$day->move(1000, 500);
echo ' С GPS + ' . $day->withgps(500) . ' рублей.';
$day->withDriver();
echo '<br>';

$student = new Student('23');
$student->move(20, 65);
echo ' С GPS + ' . $student->withgps(65). ' рублей.';