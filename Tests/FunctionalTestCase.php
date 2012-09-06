<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Tests\UtilityAssertions;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalTestCase extends WebTestCase
{

    use UtilityAssertions;

    /** @var Container */
    private $_container = null;

    /**
     * Shorthand method to get the container of the application.
     *
     * @return Container
     */
    protected function getContainer()
    {
        if (is_null($this->_container)) {
            $this->_container = static::createClient()
                ->getKernel()
                ->getContainer();
        }

        return($this->_container);
    }

    /**
     * Shorthand method to get an entity manager. Returns the default one by default.
     *
     * @param string $emName
     * @return EntityManager 
     */
    protected function getEntityManager($emName=null)
    {
        $em = $this->getContainer()
            ->get('doctrine')
            ->getEntityManager($emName);

        return($em);
    }

    /**
     * Creates a random @email.com email address.
     *
     * @return string
     */
    protected function createRandomEmail()
    {
        $email = sprintf('%s@email.com', uniqid());

        return(strtoupper($email));
    }

}
