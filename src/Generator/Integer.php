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
	*	Throws Exception if uneven int.
	*
	*	@param int $int
	*	@throws LogicException
	*/
	protected function throwExceptionIfUneven($int)
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
			throw new \LogicException('Not a uneven number.');
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
	* 	getEven(10,20,2); // 10,14,18
	*
	*	@param int|null $start
	* 	@param int|null $end
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getEven( $start = null, $end = null, $step = 1 )
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$start, $end] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$start, $end] );

		// infinite increase range
		if(is_int($start) && is_null($end)) 
		{
			// throw LogicException
			$this->throwExceptionIfUneven($start);

			$Generator = function() use ($start, $step) 
			{
				for($i = $start; true; $i += $step * 2)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($end) && is_null($start)) 
		{
			// throws LogicException
			$this->throwExceptionIfUneven($end);

			$Generator =  function() use ($end, $step)
			{
				for($i = $end; true; $i -= $step * 2)
				{
					yield $i;		
				}
			};
		}
		// predetermined range
		else 
		{
			// throws LogicException
			$this->throwExceptionIfUneven($start);
			$this->throwExceptionIfUneven($end);

			$Generator = function() use ($start, $end, $step) 
			{
				if($start >= $end)
				{
					for($i = $start; $i >= $end; $i -= $step * 2)
					{
						yield $i;
					}
				}
				else
				{
					for($i = $start; $i <= $end; $i += $step * 2)
					{
						yield $i;
					}
				}
			};
		}

		return $Generator();
	}


	/**
	*	Returns a Generator with a uneven range.
	*
	*	getUneven(11); // 11,13,15,17 ...
	*	getUneven(null, 11); // 11,9,7,5,3 ...
	*	getUneven(11, null, 2); // 11,7,3, -1 ...
	*	getUneven(11,21); // 11,13,15,17,19,21
	*	getUneven(21,11); // 21,19,18,17,15,13,11
	* 	getUneven(11,21,2); // 11,15,19
	*
	*	@param int|null $start
	* 	@param int|null $end
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getUneven( $start = null, $end = null, $step = 1 )
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$start, $end] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$start, $end] );

		// infinite increase range
		if(is_int($start) && is_null($end)) 
		{
			// throw LogicException
			$this->throwExceptionIfEven($start);

			$Generator = function() use ($start, $step) 
			{
				for($i = $start; true; $i += $step * 2)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($end) && is_null($start)) 
		{
			// throws LogicException
			$this->throwExceptionIfEven($end);

			$Generator =  function() use ($end, $step)
			{
				for($i = $end; true; $i -= $step * 2)
				{
					yield $i;		
				}
			};
		}
		// predetermined range
		else 
		{
			// throws LogicException
			$this->throwExceptionIfEven($start);
			$this->throwExceptionIfEven($end);

			$Generator = function() use ($start, $end, $step) 
			{
				if($start >= $end)
				{
					for($i = $start; $i >= $end; $i -= $step * 2)
					{
						yield $i;
					}
				}
				else
				{
					for($i = $start; $i <= $end; $i += $step * 2)
					{
						yield $i;
					}
				}
			};
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
	*	@param int|null $start
	* 	@param int|null $end
	*	@param int $step
	*	@throws InvalidArgumentException|LogicException
	*	@return Generator
	*/
	public function getRange($start = null, $end = null, $step = 1)
	{
		// Throws LogicException
		$this->throwExceptionIfAllNulls( [$start, $end] );
		$this->throwExceptionIfInvalidStep($step);

		// Throws InvalidArgumentException
		$this->throwExceptionIfNotNullOrInt( [$start, $end] );

		// infinite increase range
		if(is_int($start) && is_null($end)) 
		{
			$Generator = function() use ($start, $step) 
			{
				for($i = $start; true; $i += $step)
				{
					yield $i;
				}
			};
		}
		// infinite decrease range
		elseif(is_int($end) && is_null($start)) 
		{
			$Generator =  function() use ($end, $step)
			{
				for($i = $end; true; $i -= $step)
				{
					yield $i;		
				}
			};
		}
		// predetermined range
		else 
		{
			$Generator = function() use ($start, $end, $step) 
			{
				if($start >= $end)
				{
					for($i = $start; $i >= $end; $i -= $step)
					{
						yield $i;
					}
				}
				else
				{
					for($i = $start; $i <= $end; $i += $step)
					{
						yield $i;
					}
				}
			};
		}

		return $Generator();
	}
}