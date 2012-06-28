<?php

namespace Deuteron\Bundle\ProjectBundle\Menu\Voter;

use Symfony\Component\DependencyInjection\ContainerInterface,
    Knp\Menu\ItemInterface,
    Knp\Menu\Matcher\Voter as KnpMenuVoter
;

/**
 * Voter based on the uri
 */
class UriVoter implements KnpMenuVoter\VoterInterface
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Checks whether an item is current.
     *
     * If the voter is not able to determine a result,
     * it should return null to let other voters do the job.
     *
     * @param ItemInterface $item
     * @return boolean|null
     */
    public function matchItem(ItemInterface $item)
    {
        if ($item->getUri() === $this->container->get('request')->getRequestUri()) {
            return true;
        }

        return null;
    }
}
