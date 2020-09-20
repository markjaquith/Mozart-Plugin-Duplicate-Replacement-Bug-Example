<?php
/*
Plugin Name: Mozart Plugin Duplicate Replacement Bug Example
Author: Mark Jaquith
*/

namespace MarkJaquith\MozartDuplicateReplacementBug;

use MarkJaquith\MozartDuplicateReplacementBug\Mozart\DI\Container;

require __DIR__ . '/vendor/autoload.php';

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
	new Container();
});
