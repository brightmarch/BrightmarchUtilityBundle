<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Tests\Mixin\UtilityAssertionsMixin;

use \PHPUnit_Framework_TestCase;

abstract class UnitTestCase extends PHPUnit_Framework_TestCase
{

    use UtilityAssertionsMixin;

}
