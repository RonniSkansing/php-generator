<?php
require_once('vendor/autoload.php');

// Create a instance of numeric generator;
$NumGen = new Generator\Numeric;


/**
*	Range Generator
*/

// Create a range generator
$RangeGen = $NumGen->getRange(15, 20);
// use the generator
foreach($RangeGen as $int)
{
	echo $int . PHP_EOL; // 15, 16, 17, 18
}

// create a infinite range
$RangeGen = $NumGen->getRange(15);
foreach($RangeGen as $int)
{
	if($int === 100)
	{
		break;
	}

	echo $int . PHP_EOL; // 15, 16, 17, 18 ... 99
}

// create a decreasing infinite range
$RangeGen = $NumGen->getRange(null, 15);
foreach($RangeGen as $int)
{
	if($int === -5)
	{
		break;
	}

	echo $int . PHP_EOL; // 15, 14 ... -5
}

// can step on range...
$RangeGen = $NumGen->getRange(10, 100, 10);
foreach($RangeGen as $int)
{
	echo $int . PHP_EOL; // 10, 20 ... 100
}


/**
*	Fibo Generator
*/

// creates a infinite fibbo
$FibGen = $NumGen->getFibonacci();
$c = 0;
foreach($FibGen as $int)
{
	if(is_infinite($int))
	{
		break;
	}
	echo $int . PHP_EOL; // 0,1,1,2 ... 
	++$c;
}
var_dump($c); // depeands on platform (INF)

// create a decreasing fibbo
$FibGen = $NumGen->getFibonacci(false);
foreach($FibGen as $int)
{
	if(is_infinite($int))
	{
		break;
	}
	echo $int . PHP_EOL; // 0,1,1,2 ... 
}

// create a increasing fibo with step
$FibGen = $NumGen->getFibonacci(true, null, 2);
foreach($FibGen as $int)
{
	if(is_infinite($int))
	{
		break;
	}
	echo $int . PHP_EOL; // 0,1,5 ... 
}


// create a range of fibo with step
$FibGen = $NumGen->getFibonacci(true, 10000, 2);
foreach($FibGen as $int)
{
	if(is_infinite($int))
	{
		break;
	}
	echo $int . PHP_EOL; // 0,1,5 ... 
}


/**
*	Prime Generator
*/

// infinite primes... beware not an effective prime algo
$FibGen = $NumGen->getPrimes();
$i = 1;
foreach($FibGen as $int)
{
	if($int > 100)
	{
		break;
	}
	echo 'Prime # ' . $i . ' ' . $int . PHP_EOL; // 2,3,5,7 ...
	++$i;
}

// infinite primes starting from 50
$FibGen = $NumGen->getPrimes(50);
foreach($FibGen as $int)
{
	if($int > 100)
	{
		break;
	}
	echo $int . PHP_EOL; // 53,59,61 ...
	++$i;
}

// infinite primes between 50 and 80
$FibGen = $NumGen->getPrimes(50, 80);
foreach($FibGen as $int)
{
	echo $int . PHP_EOL; // 53,59,61 ... 79
	++$i;
}