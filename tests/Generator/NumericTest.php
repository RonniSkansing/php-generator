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
	public function testGetEvenThrowsExceptionIfArgsIsNotInt()
	{
		$Generator = $this->Numeric->getEven('string','string');
	}


	/**
	*	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Numeric->getEven(10,20,0);	
	}


	/**
	*	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Numeric->getEven();
	}


	/**
	* 	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfArgsIsUneven()
	{
		$Generator = $this->Numeric->getEven(2,5);
	}


	public function testGetEvenCanIncreaseInfinite()
	{
		$Generator = $this->Numeric->getEven(10);
		foreach($Generator as $int) 
			if($int === 32)
				break;

		$this->assertEquals(32, $int);	
	}


	public function testGetEvenCanDecreaseInfinite()
	{
		$Generator = $this->Numeric->getEven(null, 10);
		foreach($Generator as $int) 
		{
			if($int === -32)
				break;	
		}
		
		$this->assertEquals(-32, $int);	
	}


	public function testGetEvenCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Numeric->getEven(null, 10, 2);
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
			if($int === -18)
				break;
		}
		$this->assertEquals($result[7], $int);		
	}


	public function testGetEvenGeneratesEncreaseInRange() 
	{
		$Generator = $this->Numeric->getEven(10,20);
		foreach($Generator as $int) {}

		$this->assertEquals(20, $int);
	}


	public function testGetEvenCanDecreaseInRange()
	{
		$Generator = $this->Numeric->getEven(20,10);
		foreach($Generator as $int) {}
		$this->assertEquals(10, $int);	
	}


	public function testGetEvenIgnoresIfOutOfBounds()
	{
		$Generator = $this->Numeric->getEven(10,20, 2);
		foreach($Generator as $int) {}
		$this->assertEquals(18, $int);
	}

	public function testGetEvenCanStep()
	{
		$Generator = $this->Numeric->getEven(20,10, 3);
		$result = [];
		foreach($Generator as $int) {
			$result[] = $int;
		}
		$this->assertEquals($result[0], 20);
		$this->assertEquals($result[1], 14);
	}

	/**
	* 	@expectedException InvalidArgumentException
	*/
	public function testgetOddThrowsExceptionIfArgsIsNotInt()
	{
		$Generator = $this->Numeric->getOdd('string','string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Numeric->getOdd(11,33,0);	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Numeric->getOdd();
	}

	/**
	* 	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfArgsIsEven()
	{
		$Generator = $this->Numeric->getOdd(1,6);
	}

	public function testgetOddCanIncreaseInfinite()
	{
		$Generator = $this->Numeric->getOdd(1);
		foreach($Generator as $int) 
			if($int === 33)
				break;

		$this->assertEquals(33, $int);	
	}

	public function testgetOddCanDecreaseInfinite()
	{
		$Generator = $this->Numeric->getOdd(null, 11);
		foreach($Generator as $int) 
			if($int === -33)
				break;

		$this->assertEquals(-33, $int);	
	}


	public function testgetOddCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Numeric->getOdd(null, 11, 2);
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
			if($int === -17)
				break;
		}

		$this->assertEquals($result[7], $int);		
	}

	public function testgetOddGeneratesEncrease() 
	{
		$Generator = $this->Numeric->getOdd(11,21);
		foreach($Generator as $int) {}
		$this->assertEquals(21, $int);
	}

	public function testgetOddCanDecrease()
	{
		$Generator = $this->Numeric->getOdd(21,11);
		foreach($Generator as $int) {}
		$this->assertEquals(11, $int);	
	}

	public function testgetOddIgnoresIfOutOfBounds()
	{
		$Generator = $this->Numeric->getOdd(11,21, 2);
		foreach($Generator as $int) {}
		$this->assertEquals(19, $int);
	}

	public function testgetOddCanStep()
	{
		$Generator = $this->Numeric->getOdd(21,11, 3);
		$result = [];
		foreach($Generator as $int) {
			$result[] = $int;
		}
		$this->assertEquals($result[0], 21);
		$this->assertEquals($result[1], 15);
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
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
			if($int === -5)
				break;
		}

		$this->assertEquals($result[4], $int);		
	}

	public function testGetRangeGeneratesEncrease() 
	{
		$Generator = $this->Numeric->getRange(11,21);
		foreach($Generator as $int) {}
		$this->assertEquals(21, $int);
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
		$this->assertEquals($result[1], 15);
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

	public function testGetFibonacciCanMakeALimitedDelimitedSequence()
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
	public function testGetPrimeThrowsExceptionIfArgsNotIntOrNull() {
		$Generator = $this->Numeric->getPrime('string', 'string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimeThrowsExceptionIfIndexLowerThen0() {
		$Generator = $this->Numeric->getPrime(-1);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimeThrowsExceptionIfIndexHigherOrEqualThenLimit()
	{
		$Generator = $this->Numeric->getPrime(10,1);
	}

	public function testGetPrimeNextPrimeIs2IfLowerThen2()
	{
		$Generator = $this->Numeric->getPrime(0,10);
		$this->assertEquals(2, $Generator->current());
	}

	public function testGetPrimeNextPrimeIsOnlyCheckOddNumbers()
	{
		// fill in
	}

	public function testGetPrimeHighstPrimeNarrows()
	{
		$Generator = $this->Numeric->getPrime(0, 100);
		foreach($Generator as $prime)
		{
			$last_prime = $prime;
		}

		$this->assertEquals($last_prime, $last_prime);
	}


}