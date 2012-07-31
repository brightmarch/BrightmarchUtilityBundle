<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Tests\UtilityAssertions;

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
     * Shorthand method to get an entity manager. Returns the default one by default.
     *
     * @param string The entity manager name to retrieve.
     *
     * @return EntityManager The default entity manager.
     */
    protected function getEntityManager($emName = null)
    {
        $client = static::createClient();
        $em = $client->getKernel()
            ->getContainer()
            ->get('doctrine')
            ->getEntityManager($emName);

        return($em);
    }

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
