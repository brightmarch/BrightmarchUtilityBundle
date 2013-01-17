<?php

namespace Brightmarch\Bundle\UtilityBundle\Tests;

use Brightmarch\Bundle\UtilityBundle\Tests\Mixin\UtilityAssertionsMixin;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

abstract class FunctionalTestCase extends WebTestCase
{

    use UtilityAssertionsMixin;

    /** @var Container */
    private $_container = null;

    /** @var Client */
    private $_client = null;

    /**
     * Shorthand method to get the container
     * of the application.
     *
     * @return Container
     */
    protected function getContainer()
    {
        if (is_null($this->_container)) {
            $this->_container = $this->getKernel()
                ->getContainer();
        }

        return $this->_container;
    }

    /**
     * Gets the Web Client object to navigate
     * each request.
     *
     * @return Client
     */
    protected function getHttpClient()
    {
        if (is_null($this->_client)) {
            $this->_client = static::createClient();
        }

        return $this->_client;
    }

    /**
     * Gets the current AppKernel object.
     *
     * @return AppKernel
     */
    protected function getKernel()
    {
        return $this->getHttpClient()->getKernel();
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

        return $em;
    }

    /**
     * Creates a random @brightmarch.com email address.
     *
     * @return string
     */
    protected function createRandomEmail()
    {
        $email = sprintf('%s@brightmarch.com', uniqid());

        return strtolower($email);
    }

}
