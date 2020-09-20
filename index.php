<?php
/*
Plugin Name: Mozart Plugin Duplicate Replacement Bug Example
Author: Mark Jaquith
*/

namespace MarkJaquith\MozartDuplicateReplacementBug;

use MarkJaquith\MozartDuplicateReplacementBug\Mozart\DI;
use MarkJaquith\MozartDuplicateReplacementBug\Mozart\DI\Container;

require __DIR__ . '/vendor/autoload.php';

// Working around https://github.com/coenjacobs/mozart/issues/66
require __DIR__ . '/lib/Mozart/DI/functions.php';

class Example {}

add_action('init', function() {
	// This call fails, because in DI/Container.php, a use statement that started like this:
	//
	// use DI\Invoker\DefinitionParameterResolver;
	//
	// and should be transformed to this:
	//
	// MarkJaquith\MozartDuplicateReplacementBug\Mozart\DI\Invoker\DefinitionParameterResolver
	//
	// is instead transformed to this:
	//
	// MarkJaquith\DuplicateReplacementBug\Mozart\DI\MarkJaquith\DuplicateReplacementBug\Mozart\Invoker\DefinitionParameterResolver
	//
	$container = new Container();
	$container->set(Example::class, DI\factory(function(Example $example, $foo) {
		return $foo;
	})->parameter('foo', 'FOO VALUE'));
	$container->get(Example::class);
});
