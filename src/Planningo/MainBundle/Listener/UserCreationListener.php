<?php
/**
 * Created by PhpStorm.
 * For project : planningo
 * Author : Alexandre Choisy <alexandre.choisy@arengi.fr>
 * Date : 12/07/2016 at 15:32
 */

namespace Planningo\MainBundle\Listener;

use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCreationListener implements EventSubscriberInterface
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
            FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess',
        );
    }

    public function onRegistrationSuccess(FormEvent $event)
    {
        $this->user = $event->getForm()->getData();
        $entity = $this->em->getRepository('PlanningoMainBundle:Group')->find(1); // You could do that by Id, too
        $this->user->addGroup($entity);
        $this->em->flush();
    }
}