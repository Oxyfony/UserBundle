<?php
/**
 * This file is part of the Oxyfony User Bundle
 *
 * (c) 2014 Oxyfony
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (is_file($autoloadFile = __DIR__.'/../vendor/autoload.php')) {
	require $autoloadFile;
} else {
	throw new \LogicException('Could not find autoload.php in vendor/. Did you run "composer install --dev"?');
}
