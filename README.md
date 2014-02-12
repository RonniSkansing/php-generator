php-generator
=============
PHP 5.5 introduces `generators`. This is a small package with a couple common generators.

*Generators are fun and almost everyone likes having fun...*

I might come back to this project to update the algo's for the generators or to add more generators.

Atm. it contains only 1 class, Generator\Numeric. This has a range, fibonacci and prime Generator.


Contribute
-------------------------
Anyone is welcome to fork, add generators (also classes like a File reader gen or whatever), improve algos and send pull requests.


How to use
-------------------------
Install via composer, remember to include the autoload or do it your own way ;)
`
{
    "require": {
        "ronnieskansing/generators": "dev-master"
    }
}
`


How to really use
-------------------------
*Create a generator type (only one to find at the moment.. ( maybe forever... ) )*

At the moment you can find examples of use in the examples.php


Infinite? 
-------------------------
No, beware that some methods allow for infinite iteration, but this is in all cases matched against php native INF constant.
So the max value is tied to the platform of the server. For a good example on this.. try ->


`
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
`
