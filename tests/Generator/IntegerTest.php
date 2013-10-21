<?php

class NumericGeneratorTest extends PHPUnit_Framework_TestCase {


	protected $Integer;


	public function setup()
	{
		$this->Integer = new Generator\Integer;
	}


	/**
	* 	@expectedException InvalidArgumentException
	*/
	public function testGetEvenThrowsExceptionIfArgsIsNotInt()
	{
		$Generator = $this->Integer->getEven('string','string');
	}


	/**
	*	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Integer->getEven(10,20,0);	
	}


	/**
	*	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Integer->getEven();
	}


	/**
	* 	@expectedException LogicException
	*/
	public function testGetEvenThrowsExceptionIfArgsIsUneven()
	{
		$Generator = $this->Integer->getEven(2,5);
	}


	public function testGetEvenCanIncreaseInfinite()
	{
		$Generator = $this->Integer->getEven(10);
		foreach($Generator as $int) 
			if($int === 32)
				break;

		$this->assertEquals(32, $int);	
	}


	public function testGetEvenCanDecreaseInfinite()
	{
		$Generator = $this->Integer->getEven(null, 10);
		foreach($Generator as $int) 
			if($int === -32)
				break;

		$this->assertEquals(-32, $int);	
	}


	public function testGetEvenCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Integer->getEven(null, 10, 2);
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
			if($int === -18)
				break;
		}

		$this->assertEquals($result[7], $int);		
	}


	public function testGetEvenGeneratesEncrease() 
	{
		$Generator = $this->Integer->getEven(10,20);
		foreach($Generator as $int) {}
		$this->assertEquals(20, $int);
	}


	public function testGetEvenCanDecrease()
	{
		$Generator = $this->Integer->getEven(20,10);
		foreach($Generator as $int) {}
		$this->assertEquals(10, $int);	
	}


	public function testGetEvenIgnoresIfOutOfBounds()
	{
		$Generator = $this->Integer->getEven(10,20, 2);
		foreach($Generator as $int) {}
		$this->assertEquals(18, $int);
	}

	public function testGetEvenCanStep()
	{
		$Generator = $this->Integer->getEven(20,10, 3);
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
		$Generator = $this->Integer->getOdd('string','string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Integer->getOdd(11,33,0);	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Integer->getOdd();
	}

	/**
	* 	@expectedException LogicException
	*/
	public function testgetOddThrowsExceptionIfArgsIsEven()
	{
		$Generator = $this->Integer->getOdd(1,6);
	}

	public function testgetOddCanIncreaseInfinite()
	{
		$Generator = $this->Integer->getOdd(1);
		foreach($Generator as $int) 
			if($int === 33)
				break;

		$this->assertEquals(33, $int);	
	}

	public function testgetOddCanDecreaseInfinite()
	{
		$Generator = $this->Integer->getOdd(null, 11);
		foreach($Generator as $int) 
			if($int === -33)
				break;

		$this->assertEquals(-33, $int);	
	}


	public function testgetOddCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Integer->getOdd(null, 11, 2);
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
		$Generator = $this->Integer->getOdd(11,21);
		foreach($Generator as $int) {}
		$this->assertEquals(21, $int);
	}

	public function testgetOddCanDecrease()
	{
		$Generator = $this->Integer->getOdd(21,11);
		foreach($Generator as $int) {}
		$this->assertEquals(11, $int);	
	}

	public function testgetOddIgnoresIfOutOfBounds()
	{
		$Generator = $this->Integer->getOdd(11,21, 2);
		foreach($Generator as $int) {}
		$this->assertEquals(19, $int);
	}

	public function testgetOddCanStep()
	{
		$Generator = $this->Integer->getOdd(21,11, 3);
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
		$Generator = $this->Integer->getRange('string','string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetRangeThrowsExceptionIfStepIsBelow1()
	{
		$Generator = $this->Integer->getRange(11,33,0);	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetRangeThrowsExceptionIfNoArgsIsPassed()
	{
		$Generator = $this->Integer->getRange();
	}

	public function testGetRangeCanIncreaseInfinite()
	{
		$Generator = $this->Integer->getRange(1);
		foreach($Generator as $int) 
			if($int === 33)
				break;

		$this->assertEquals(33, $int);	
	}

	public function testGetRangeCanDecreaseInfinite()
	{
		$Generator = $this->Integer->getRange(null, 11);
		foreach($Generator as $int) 
			if($int === -33)
				break;

		$this->assertEquals(-33, $int);	
	}


	public function testGetRangeCanDecreaseInfiniteInSteps()
	{
		$Generator = $this->Integer->getRange(null, 11, 2);
		$result = [];
		foreach($Generator as $int) 
		{
			$result[] = $int;
			if($int === -5)
				break;
		}

		$this->assertEquals($result[8], $int);		
	}

	public function testGetRangeGeneratesEncrease() 
	{
		$Generator = $this->Integer->getRange(11,21);
		foreach($Generator as $int) {}
		$this->assertEquals(21, $int);
	}

	public function testGetRangeCanDecrease()
	{
		$Generator = $this->Integer->getRange(21,11);
		foreach($Generator as $int) {}
		$this->assertEquals(11, $int);	
	}

	public function testGetRangeIgnoresIfOutOfBounds()
	{
		$Generator = $this->Integer->getRange(0,21, 5);
		foreach($Generator as $int) {}
		$this->assertEquals(20, $int);
	}

	public function testGetRangeCanStep()
	{
		$Generator = $this->Integer->getRange(21,11, 3);
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
		$Generator = $this->Integer->getFibonacci('string');
	}

	/**
	*	@expectedException InvalidArgumentException
	*/
	public function testGetFibonacciThrowsExceptionIfSecondArgNotNullOrInt()
	{
		$Generator = $this->Integer->getFibonacci(true, 'string');	
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfFirstArgFalseAndSecondArgIsInt0OrHigher()
	{
		$Generator = $this->Integer->getFibonacci(false, 0);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfFirstArgTrueAndSecondArgIsInt0OrBelow()
	{
		$Generator = $this->Integer->getFibonacci(true, 0);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetFibonacciThrowsExceptionIfStepBelow1()
	{
		$Generator = $this->Integer->getFibonacci(true, null, 0);	
	}

	public function testGetFibonacciCreatesInfiniteSequenceNoArgs()
	{
		$Generator = $this->Integer->getFibonacci();
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
		$Generator = $this->Integer->getFibonacci(true, null, 2);
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
		$Generator = $this->Integer->getFibonacci(false);
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
		$Generator = $this->Integer->getFibonacci(false, null, 2);
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
		$Generator = $this->Integer->getFibonacci(true, 10);
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
		$Generator = $this->Integer->getFibonacci(true, 10, 2);
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
		$Generator = $this->Integer->getFibonacci(false, -10);
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
		$Generator = $this->Integer->getFibonacci(false, -10, 2);
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
		$Generator = $this->Integer->getPrime('string', 'string');
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimeThrowsExceptionIfIndexLowerThen0() {
		$Generator = $this->Integer->getPrime(-1);
	}

	/**
	*	@expectedException LogicException
	*/
	public function testGetPrimeThrowsExceptionIfIndexHigherOrEqualThenEnd()
	{
		$Generator = $this->Integer->getPrime(10,1);
	}

	public function testGetPrimeNextPrimeIs2IfLowerThen2()
	{
		$Generator = $this->Integer->getPrime(0,10);
		$this->assertEquals(2, $Generator->current());
	}

	public function testGetPrimeHighstPrimeNarrows()
	{
		$Generator = $this->Integer->getPrime(50, 100);
		foreach($Generator as $prime){}
		$this->assertEquals(97, $Generator->current());
	}


}