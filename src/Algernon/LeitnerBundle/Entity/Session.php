<?php

namespace Algernon\LeitnerBundle\Entity;

/**
 * @orm:Entity
 */
class Session
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:Column(type="integer")
     */
    protected $currentSession;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set currentSession
     *
     * @param integer $currentSession
     */
    public function setCurrentSession($currentSession)
    {
      $this->currentSession = $currentSession;
    }

    /**
     * Get currentSession
     *
     * @return integer $currentSesssion
     */
    public function getCurrentSession()
    {
      return $this->currentSession;
    }
}
