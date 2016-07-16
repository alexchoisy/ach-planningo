<?php
/**
 * Created by PhpStorm.
 * For project : planningo
 * Author : Alexandre Choisy <alexandre.choisy@arengi.fr>
 * Date : 12/07/2016 at 14:45
 */

namespace Planningo\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="p_group")
 */
class Group extends BaseGroup
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="groups", cascade={"persist"})
     */
    protected $users;

    /**
     * @inheritdoc
     */
    public function __construct($name, $roles = array()) {
        parent::__construct($name, $roles = array());
        $this->users = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    public function addUser(User $user) {
        $this->users->add($user);

        return $this;
    }

    public function removeUser(User $user) {
        $this->users->removeElement($user);

        return $this;
    }
}