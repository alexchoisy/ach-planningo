<?php
/**
 * Created by PhpStorm.
 * For project : planningo
 * Author : Alexandre Choisy <alexandre.choisy@arengi.fr>
 * Date : 12/07/2016 at 15:35
 */

namespace Planningo\MainBundle\Listener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GroupEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class GroupCreationListener implements EventSubscriberInterface
{
    protected $em;
    protected $user;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::GROUP_CREATE_SUCCESS => 'onGroupCreateSuccess',
        );
    }

    public function onGroupCreateSuccess(FormEvent $event)
    {
        $group = $event->getForm()->getData();
        $group->addRole('ROLE_BASIC');
    }
}