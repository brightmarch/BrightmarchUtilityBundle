<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Tests\UtilityAssertions;

use \PHPUnit_Framework_TestCase;

/**
 * Base test class for non-web or non-HTTP unit and functional tests.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
abstract class TestCase extends PHPUnit_Framework_TestCase
{

    use UtilityAssertions;

}
