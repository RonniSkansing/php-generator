<?php
namespace Generator;


class Integer {


	/**
	*	Throws Exception if all elements are null
	*
	*	@param mixed $values
	*	@throws LogicException
	*/
	protected function throwExceptionIfAllNulls(array $values)
	{
 		$types = array_map("gettype", $values);
 		$unique_types = array_unique($types);
 		if( count( $unique_types) === 1 && $unique_types[0] === "NULL")
 		{
 			throw new \LogicException('All values are null');
 		}
	}


	/**
	*	Throws Exception if odd int.
	*
	*	@param int $int
	*	@throws LogicException
	*/
	protected function throwExceptionIfodd($int)
	{
		if($int % 2 !== 0)		
		{
			throw new \LogicException('Not a even number.');
		}
	}


	/**
	*	Throws Exception if even int.
	*
	*	@param int $int
	*	@throws LogicException
	*/
	protected function throwExceptionIfEven($int)
	{
		if($int % 2 !== 1)
		{
			throw new \LogicException('Not a odd number.');
		}
	}

	/**
	*	Throws Exception if all elements passed is not integer or null
	*
	*	@param array $values
	*	@return InvalidArgumentException
	*/
	protected function throwExceptionIfNotNullOrInt( array $values )
	{
		foreach($values as $value)
		{
			if(is_null($value) === false && is_int($value) === false)
			{
				throw new \InvalidArgumentException('Not a integer or null type.');
			}
		}
	}


	/**
	*	Throws LogicException if step is over 1
	*
	*	@param int $step
	*	@throws LogicException
	*/
	protected function throwExceptionIfInvalidStep($step)
	{
		if($step < 1)
		{
			throw new \LogicException('The step must be 1 or higher');
		}
	}


	/**
	*	Returns a Generator with a even range.
	*
	*	getEven(10); // 10,12,14,16,18,20,22 ...
	*	getEven(null, 10); // 10,8,6,4,2,0,-2,-4 ...
	*	getEven(10, null, 2); // 10,6,2, -2 ...
	*	getEven(10,20); // 10,12,14,16,18,20
	*	getEven(20,10); // 20,18,16,14,12,10
	*	getEven(10,20,2); // 10,14,18
	*
	*	@param int|null $index
	*	@param int|null $limit
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getEven( $index = null, $limit = null, $step = 1 )
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$index, $limit] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$index, $limit] );

		// infinite increase range
		if(is_int($index) && is_null($limit))
		{
			// throw LogicException
			$this->throwExceptionIfodd($index);

			$Generator = function() use ($index, $step)
			{
				for($i = $index; true; $i += $step * 2)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($limit) && is_null($index))
		{
			// throws LogicException
			$this->throwExceptionIfodd($limit);

			$Generator =  function() use ($limit, $step)
			{
				for($i = $limit; true; $i -= $step * 2)
				{
					yield $i;
				}
			};
		}
		// predetermined range
		else 
		{
			// throws LogicException
			$this->throwExceptionIfodd($index);
			$this->throwExceptionIfodd($limit);

			// decrease
			if($index >= $limit)
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i >= $limit; $i -= $step * 2)
					{
						yield $i;
					}
				};
			}
			// increase
			else
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i <= $limit; $i += $step * 2)
					{
						yield $i;
					}
				};
			}
		}

		return $Generator();
	}


	/**
	*	Returns a Generator with a odd range.
	*
	*	getOdd(11); // 11,13,15,17 ...
	*	getOdd(null, 11); // 11,9,7,5,3 ...
	*	getOdd(11, null, 2); // 11,7,3, -1 ...
	*	getOdd(11,21); // 11,13,15,17,19,21
	*	getOdd(21,11); // 21,19,18,17,15,13,11
	*	getOdd(11,21,2); // 11,15,19
	*
	*	@param int|null $index
	*	@param int|null $limit
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getOdd( $index = null, $limit = null, $step = 1 )
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$index, $limit] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$index, $limit] );

		// infinite increase range
		if(is_int($index) && is_null($limit))
		{
			// throw LogicException
			$this->throwExceptionIfEven($index);

			$Generator = function() use ($index, $step)
			{
				for($i = $index; true; $i += $step * 2)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($limit) && is_null($index)) 
		{
			// throws LogicException
			$this->throwExceptionIfEven($limit);

			$Generator =  function() use ($limit, $step)
			{
				for($i = $limit; true; $i -= $step * 2)
				{
					yield $i;
				}
			};
		}
		// predetermined range
		else 
		{
			// throws LogicException
			$this->throwExceptionIfEven($index);
			$this->throwExceptionIfEven($limit);

			// increase
			if($index >= $limit)
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i >= $limit; $i -= $step * 2)
					{
						yield $i;
					}
				};
			}
			// decrease
			else
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i <= $limit; $i += $step * 2)
					{
						yield $i;
					}
				};
			}
		}

		return $Generator();
	}


	/**
	*	Returns a generator with selected range
	*
	*	getRange(1); // 1,2,3,4,5 ...
	*	getRange(null, 1); // 1,-1,-2,-3 ...
	*	getRange(10, null, 3); // 10,13,16,19 ...
	*	getRange(1, 5); // 1,2,3,4,5
	*	getRange(5, 1); // 5,4,3,2,1
	*	getRange(10, 3, 3); // 10,7,4
	*
	*	@param int|null $index
	*	@param int|null $limit
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getRange($index = null, $limit = null, $step = 1)
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$index, $limit] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$index, $limit] );

		// infinite increase range
		if(is_int($index) && is_null($limit))
		{
			$Generator = function() use ($index, $step)
			{
				for($i = $index; true; $i += $step)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($limit) && is_null($index))
		{
			$Generator =  function() use ($limit, $step)
			{
				for($i = $limit; true; $i -= $step)
				{
					yield $i;
				}
			};
		}
		// predetermined range
		else 
		{
			// decrease
			if($index >= $limit)
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i >= $limit; $i -= $step)
					{
						yield $i;
					}
				};
			}
			else
			// increase
			{
				$Generator = function() use ($index, $limit, $step)
				{
					for($i = $index; $i <= $limit; $i += $step)
					{
						yield $i;
					}
				};
			}
		}

		return $Generator();
	}


	/**
	*	Returns a generator with Fibonacci sequence
	*
	*	getFibonacci(); // 0,1,1,2,3,5 ...
	*	getFibonacci(false); // 0,-1,-1,-3 ...
	*	getFibonacci(true, null, 2); // 0,1,3 ...
	*	getFibonacci(true, 4); // 0,1,1,2,3
	*	getFibonacci(false, -5); // 0,-1,-1,-2,-3,-5
	*
	*	@param bool $increasing
	*	@param null|int $limit
	*	@param int
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getFibonacci($increasing = true, $limit = null, $step = 1)
	{
		if(is_bool($increasing) === false)
		{
			throw new \InvalidArgumentException('First argument must be a boolean, given '
												. gettype($increasing) . '.');
		}

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$limit] );

		// if infinite sequence... 
		if( is_null($limit) === false )
		{
			if($increasing === false && $limit >= 0)
			{
				throw new \LogicException('Second argument must be lower then 0 in a infinite increasing sequence.');
			}
			elseif($increasing === true && $limit <= 0)
			{
				throw new \LogicException('Second argument must be lower then 0 in a infinite decreasing sequence.');
			}
		}

		// Throws LogicException
		$this->throwExceptionIfInvalidStep($step);

		$fib = 0;
		// infinite increase
		if($increasing === true && is_null($limit))
		{
			$Generator = function() use ($fib, $step)
			{
				$x = 0;
				$y = 1;
				while(true)
				{
					yield $fib;
					// add up for next iteration and take messure for steps
					for($j = 0; $j < $step; ++$j, $fib = ($x + $y))
					{
						$x = $y;
						$y = $fib;
					}
				}
			};
		}
		// infinite decrease range
		elseif($increasing === false && is_null($limit))
		{
			$Generator = function() use ($fib, $step)
			{
				$x = 0;
				$y = -1;
				while(true)
				{
					yield $fib;
					// add up for next iteration and take messure for steps
					for($j = 0; $j < $step; ++$j, $fib = ($x + $y))
					{
						$x = $y;
						$y = $fib;
					}
				}
			};
		}
		// specific end of sequence 
		else
		{
			// increasing
			if($increasing === true)
			{
				$Generator = function() use ($fib, $limit, $step)
				{
					$x = 0;
					$y = 1;
					while($fib < $limit)
					{
						yield $fib;
						// add up for next iteration and take messure for steps
						for($j = 0; $j < $step; ++$j, $fib = ($x + $y))
						{
							$x = $y;
							$y = $fib;
						}
					}
				};
			}
			// decreasing
			else
			{
				$Generator = function() use ($fib, $limit, $step)
				{
					$x = 0;
					$y = -1;
					while($fib > $limit)
					{
						yield $fib;
						// add up for next iteration and take messure for steps
						for($j = 0; $j < $step; ++$j, $fib = ($x + $y))
						{
							$x = $y;
							$y = $fib;
						}
					}
				};
			}
		}

		return $Generator();
	}


	/**
	*	Returns a prime generator
	*	
	*	The prime generator narrows the result if limit is not a prime
	*	getPrime(0,20) // 2 .. 19
	*	getPrime(100) // returns all primes after 100 (or including 100 if it was a prime)
	*
	*	@param $index
	*	@param $limit
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getPrime($index, $limit = null) 
	{
		// throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$index, $limit] );

		if( $index < 0)
		{
			throw new \LogicException('The range is too low. Index must at least be 0.');
		}

		if( $limit <= $index )
		{
			throw new \LogicException('The limit must be larger then the index.');
		}

		// narrowing
		if($index < 2)
		{
			$index = 2;
		}
		// limited range generator
		$Generator = function() use ($index, $limit) 
		{
			if($index === 2)
			{
				yield $index;
				++$index;
			}

			// check against odd numbers
			for(; $index <= $limit; $index += 2)
			{
				if( $index % 2 === 0)
				{
					continue;
				}

				// assert against all previous numbers
				for($i = floor(sqrt($index)); $index > $i; ++$i)
				{
					if( $index % $i === 0)
					{
						continue 2;
					}
				}

				yield $index;
			}
		};

		return $Generator();
	}
}