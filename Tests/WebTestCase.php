<?php

namespace Brightmarch\UtilityBundle\Tests;

use Brightmarch\UtilityBundle\Tests\UtilityAssertions;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as SymfonyWebTestCase;

/**
 * Base test class for Web and HTTP based unit and functional tests.
 *
 * @author Vic Cherubini <vic@brightmarch.com>
 */
abstract class WebTestCase extends SymfonyWebTestCase
{

    use UtilityAssertions;

    /**
     * Creates a random @email.com email address.
     *
     * @return string A random always unique email address.
     */
    protected function createRandomEmail()
    {
        $email = sprintf('%s@email.com', uniqid());

        return(strtoupper($email));
    }

}
