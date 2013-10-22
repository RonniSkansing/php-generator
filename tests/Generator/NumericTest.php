<?php

class NumericGeneratorTest extends PHPUnit_Framework_TestCase {


	protected $Numeric;


	public function setup()
	{
		$this->Numeric = new Generator\Numeric;
	}

	/**
	* 	@expectedException InvalidArgumentException
	*/
	public function testGetRangeThrowsExceptionIfArgsIsNotInt()
	{
		$Generator = $this->Numeric->getRange('string','string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetRangeThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Numeric->getRange(11,33,0);	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetRangeThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Numeric->getRange();
	}

	public function testGetRangeCanIncreaseInfinite()
	{
		$Generator = $this->Numeric->getRange(1);
		foreach($Generator as $int) 
			if($int === 33)
				break;

		$this->assertEquals(33, $int);	
	}

	public function testGetRangeCanDecreaseInfinite()
	{
		$Generator = $this->Numeric->getRange(null, 11);
		foreach($Generator as $int) 
			if($int === -33)
				break;

		$this->assertEquals(-33, $int);	
	}


	public function testGetRangeCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Numeric->getRange(null, 11, 2);
		$rannge = [];
		foreach($Generator as $int) 
		{
			if($int <= 2)
			{
				break;
			}
			$range[] = $int;
		}

		$expected = [11,9,7,5,3];
		$this->assertEquals($expected, $range);		
	}

	public function testGetRangeGeneratesEncrease() 
	{
		$Generator = $this->Numeric->getRange(11,21);
		$range = [];
		foreach($Generator as $int) {
			$range[] = $int;
		}
		$expected = [11,12,13,14,15,16,17,18,19,20,21];
		$this->assertEquals($expected, $range);
	}

	public function testGetRangeCanDecrease()
	{
		$Generator = $this->Numeric->getRange(21,11);
		foreach($Generator as $int) {}
		$this->assertEquals(11, $int);	
	}

	public function testGetRangeIgnoresIfOutOfBounds()
	{
		$Generator = $this->Numeric->getRange(0,21, 5);
		foreach($Generator as $int) {}
		$this->assertEquals(20, $int);
	}

	public function testGetRangeCanStep()
	{
		$Generator = $this->Numeric->getRange(21,11, 3);
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
		}

		$this->assertEquals($result[0], 21);
		$this->assertEquals($result[1], 18);
	}

	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testGetFibonacciThrowsExceptionIfFirstArgNotBool() 
	{
		$Generator = $this->Numeric->getFibonacci('string');
	}

	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testGetFibonacciThrowsExceptionIfSecondArgNotNullOrInt()
	{
		$Generator = $this->Numeric->getFibonacci(true, 'string');	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfFirstArgFalseAndSecondArgIsInt0OrHigher()
	{
		$Generator = $this->Numeric->getFibonacci(false, 0);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfFirstArgTrueAndSecondArgIsInt0OrBelow()
	{
		$Generator = $this->Numeric->getFibonacci(true, 0);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfStepBelow1()
	{
		$Generator = $this->Numeric->getFibonacci(true, null, 0);	
	}

	public function testGetFibonacciCreatesInfiniteSequenceNoArgs()
	{
		$Generator = $this->Numeric->getFibonacci();
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib > 21) 
			{
				break;
			}
			$result[] = $fib;
		}
		$fibbo = [0,1,1,2,3,5,8,13,21];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanInfiniteIncreaseInSteps()
	{
		$Generator = $this->Numeric->getFibonacci(true, null, 2);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib > 21)
			{
				break;
			}
			$result[] = $fib;
		}

		$fibbo = [0,1,3,8,21];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanInfiniteDecrease()
	{
		$Generator = $this->Numeric->getFibonacci(false);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib < -25) 
			{
				break;
			}
			$result[] = $fib;
		}
		$fibbo = [0,-1,-1,-2,-3,-5,-8,-13,-21];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanInfiniteDecreaseInSteps()
	{
		$Generator = $this->Numeric->getFibonacci(false, null, 2);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib < -25)
			{
				break;
			}
			$result[] = $fib;
		}
		$fibbo = [-0,-1,-3,-8,-21];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanMakeALimitedIncreasingSequence()
	{
		$Generator = $this->Numeric->getFibonacci(true, 10);
		$result = [];

		foreach($Generator as $fib)
		{
			if($fib > 21) 
			{
				break;
			}
			$result[] = $fib;
		}

		$fibbo = [0,1,1,2,3,5,8];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanMakeALimitedIncreasingSequenceWithStep()
	{
		$Generator = $this->Numeric->getFibonacci(true, 10, 2);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib > 10) 
			{
				break;
			}
			$result[] = $fib;
		}
		$fibbo = [0,1,3,8];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanMakeALimitedDecreasingSequence()
	{
		$Generator = $this->Numeric->getFibonacci(false, -10);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib < -10) 
			{
				break;
			}
			$result[] = $fib;
		}

		$fibbo = [-0,-1,-1,-2,-3,-5,-8];
		$this->assertEquals($fibbo, $result);
	}

	public function testGetFibonacciCanMakeALimitedDelimitedSequenceWithStep()
	{
		$Generator = $this->Numeric->getFibonacci(false, -10, 2);
		$result = [];
		foreach($Generator as $fib)
		{
			if($fib < -10) 
			{
				break;
			}
			$result[] = $fib;
		}
		$fibbo = [-0,-1,-3,-8];
		$this->assertEquals($fibbo, $result);	
	}

	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testGetPrimesThrowsExceptionIfArgsNotIntOrNull() {
		$Generator = $this->Numeric->getPrimes('string', 'string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimesThrowsExceptionIfIndexLowerThen0() {
		$Generator = $this->Numeric->getPrimes(-1);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimesThrowsExceptionIfIndexHigherOrEqualThenLimit()
	{
		$Generator = $this->Numeric->getPrimes(10,1);
	}

	public function testGetPrimesNextPrimeIs2IfLowerThen2()
	{
		$Generator = $this->Numeric->getPrimes(0,10);
		$this->assertEquals(2, $Generator->current());
	}

	public function testGetPrimesHighstPrimeNarrows()
	{
		$Generator = $this->Numeric->getPrimes(0, 100);
		foreach($Generator as $prime)
		{
			$last_prime = $prime;
		}

		$this->assertEquals($last_prime, $last_prime);
	}

	public function testGetPrimesCanCreateNarrowRange() 
	{
		$Generator = $this->Numeric->getPrimes(4, 20);
		$primes = [];
		foreach($Generator as $prime)
		{
			$primes[] = $prime;
		}

		$this->assertEquals([5, 7, 11, 13, 17, 19], $primes);
	}

	public function testGetPrimesWithNoArgsIsInfinite()
	{
		$Generator = $this->Numeric->getPrimes();
		$primes = [];
		foreach($Generator as $prime)
		{
			if($prime > 20)
			{
				break;
			}

			$primes[] = $prime;
		}

		$this->assertEquals([2, 3, 5, 7, 11, 13, 17, 19], $primes);
	}

	public function testGetPrimesWithInfiniteWithIndexOtherHigherThen2()
	{
		$Generator = $this->Numeric->getPrimes(3);
		$primes = [];
		foreach($Generator as $prime)
		{
			if($prime > 20)
			{
				break;
			}

			$primes[] = $prime;
		}

		$this->assertEquals([3, 5, 7, 11, 13, 17, 19], $primes);	
	}
}