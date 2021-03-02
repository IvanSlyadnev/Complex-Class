<?php
class Complex {
	private $x;
	private $y;
	private $name;

	function  __construct ($x, $y, $name = '') 
	{
		$this->x = $x;
		$this->y = $y;
		$this->name = $name;
	}

	public function show () 
	{

		echo $this->name . ' = ';
		if ($this->x == 0) echo $this->y.'i'."<br>";
		else if ($this->y > 0) echo $this->x . '+' . $this->y . 'i'."<br>";
		else if ($this->y < 0) echo $this->x . $this->y . 'i'."<br>";
		else echo $this->x."<br>";
 	}

 	public function getX() {
 		return $this->x;
 	}

 	public function getY() {
 		return $this->y;
 	}

 	public static function sum(Complex $z1, Complex $z2, $name) {
		return new Complex($z1->getX()+$z2->getX(), $z1->getY()+$z2->getY(), $name);	
	}

	public static function min(Complex $z1, Complex $z2, $name) {
		return new Complex($z1->getX()-$z2->getX(), $z1->getY()-$z2->getY(), $name);
	}

	public static function mul(Complex $z1, Complex $z2, $name = '') {	
		return new Complex($z1->getX()*$z2->getX() - $z1->getY()*$z2->getY(), 
			$z1->getX()*$z2->getY()+$z2->getX()*$z1->getY(), $name);
	}
	public static function dev(Complex $z1, Complex $z2, $name) {
		if ($z2->getX() != 0 || $z2->getY() != 0) {
			$z2_ = new Complex($z2->getX(), -$z2->getY());
			$numerator = self::mul($z1, $z2_);
			$deminator = self::mul($z2, $z2_);
			return new Complex($numerator->getX()/$deminator->getX(),
					$numerator->getY()/$deminator->getX(), $name);
			
		}
	}
}

$z1 = new Complex(5, 2, 'z1');

$z2 = new Complex(3, -4,'z2');

$z1->show();
$z2->show();
$z3 = Complex::sum($z1, $z2, 'z3');
$z3->show();
$z4 = Complex::min($z1,$z2, 'z4');
$z4->show();
$z5 = Complex::mul($z1, $z2, 'z5');
$z5->show();
$z6 = Complex::dev($z1, $z2, 'z6');
$z6->show();
?>