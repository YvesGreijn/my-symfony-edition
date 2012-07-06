<?php

use \mageekguy\atoum\asserter\generator;

class BehatContext extends \Behat\Behat\Context\BehatContext
{
    /**
     * @var \ArrayObject
     */
    protected $params = array();

    /**
     * @var \mageekguy\atoum\asserter\generator
     */
    protected $assert;

    /**
     * @param array $params
     */
    public function __construct(\ArrayObject $params)
    {
        $this->params = $params;
        $this->assert = new generator();
    }

    /**
     * @param $name
     *
     * @return mixed
     */
    public function getParameter($name)
    {
       return $this->params[$name];
    }

    /**
     * @param $name
     * @param $value
     *
     * @return \Gitflow\Test\Behat\Context\BehatContext
     */
    public function setParameter($name, $value)
    {
        $this->params[$name] = $value;

        return $this;
    }
}