<?php

/**
* StaticTest Class
*/
class StaticTest
{
	static private $_StaticTest;

	function __construct()
	{
		self::$_StaticTest=array(PHP_EOL);
	}

	function reset()
	{
		self::$_StaticTest = array(PHP_EOL);
	}

	function register($that)
	{
		self::$_StaticTest = array_merge(self::$_StaticTest,array($that));
	}

	function display()
	{
		echo implode(" ", self::$_StaticTest);
	}

	function __destruct()
	{
		self::display();
		echo PHP_EOL.PHP_EOL;
	}
}

$StaticTest = new StaticTest;
$StaticTest->register('hi');
$StaticTest->register('i');
$StaticTest->register('am');
$StaticTest->register('a');
$StaticTest->register('StaticTest');
unset($StaticTest); //destruct does print!;

StaticTest::register(',');
StaticTest::register('hi');
StaticTest::register('i');
StaticTest::register('am');
StaticTest::register('a');
StaticTest::register('StaticTest');
StaticTest::display(); // print!

StaticTest::reset(); //reset!

StaticTest::register('hi');
StaticTest::register('i');
StaticTest::register('am');
StaticTest::register('a');
StaticTest::register('StaticTest');
StaticTest::display(); //works?
?>