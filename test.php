<?php
session_start();

if (isset($_POST['click'])) {
	$_POST['mx1'] = true;
	$_POST['mx2'] = true;
	$_POST['my1'] = true;
	$_POST['my2'] = true;
	$x1 = $_POST['x1'];
	$y1 = $_POST['y1'];
	$x2 = $_POST['x2'];
	$y2 = $_POST['y2'];
	if (!is_numeric($x1)) $_POST['mx1'] = false;
	if (!is_numeric($y1)) $_POST['my1'] = false;
	if (!is_numeric($x2)) $_POST['mx2'] = false;
	if (!is_numeric($y2)) $_POST['my2'] = false;
	$_SESSION['res'] = $_POST['mx1'] && $_POST['my1'] && $_POST['mx2'] && $_POST['my2'];
	
	if ($_SESSION['res']) { 

		$z1 = new Complex($x1, $y1, 'z1');

		$z2 = new Complex($x2, $y2, 'z2');

		$z3 = Complex::sum($z1, $z2, 'z3');
	
		$z4 = Complex::min($z1,$z2, 'z4');

		$z5 = Complex::mul($z1, $z2, 'z5');

		$z6 = Complex::dev($z1, $z2, 'z6');
	}

}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Комплексное число</title>
	<style type="text/css">
		.warning {
			background-color: red;
		}
	</style>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
	<form action = '' method = "post" class="form form-controll">
	<label>z1:</label>
	<br>
	<label>x:</label>
	<?php if (!$_POST['mx1']) :?>
		<label class="<?php echo (!$_POST['mx1'])?'warning':''?>">Ошибка</label>
	<?php endif;?>
	<input type="text" name="x1" placeholder="введите x" value="<?php echo ($_POST['mx1']) ? $_POST['x1'] : null ?>">
	<label>y:</label>
	<?php if (!$_POST['my1']) :?>
		<label class="<?php echo (!$_POST['my1'])?'warning':''?>">Ошибка</label>
	<?php endif;?>
	<input type="text" name="y1" placeholder="введите y" value="<?php echo ($_POST['my1']) ? $_POST['y1'] : null ?>">
	<br>
	<label>z2:</label>
	<br>
	<label>x:</label>
	<?php if (!$_POST['mx2']) :?>
		<label class="warning">Ошибка</label>
	<?php endif;?>
	<input type="text" name="x2" placeholder="введите x" value="<?php echo ($_POST['mx2']) ? $_POST['x2'] : null ?>">
	<label>y:</label>
	<?php if (!$_POST['my2']) :?>
		<label class="warning">Ошибка</label>
	<?php endif;?>
	<input type="text" name="y2" placeholder="введите y" value="<?php echo ($_POST['my2']) ? $_POST['y2'] : null ?>">
	<br>
	<input type="submit" name="click" value="Посчитать" class="btn btn-success">
</form>
<div class>
<?php if ($_SESSION['res']) :?>
<p>Вы ввели</p>  
	<?php
		$z1->show();
		$z2->show();
	?>
	<p>Результаты</p>
	
	Сумма - <?php 
		$z3->show();
	?>
		Разность -<?php
			$z4->show();
	?>
	Уможение -<?php
		$z5->show();
	?>
	Деление -	<?php
		$z6->show();
	?>	
<?php endif;?>
</div>
</div>
</body>
</html>

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


?>