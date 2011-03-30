<?php
namespace Algernon\LeitnerBundle\Entity;
use FOS\UserBundle\Entity\User as BaseUser;

/**
 * @orm:Entity
 */
class User extends BaseUser
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:generatedValue(strategy="AUTO")
     */
    protected $id;
}


