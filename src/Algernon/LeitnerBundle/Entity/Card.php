<?php
namespace Algernon\LeitnerBundle\Entity;

/**
 * @orm:Entity
 */
class Card
{
    /**
     * @orm:Id
     * @orm:Column(type="integer")
     * @orm:GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @orm:ManyToOne(targetEntity="Deck")
     * @orm:JoinColumn(name="deck_id", referencedColumnName="id")
     */
    protected $deck;

    /**
     * @orm:Column(type="string", length="255")
     */
    protected $question;

    /**
     * @orm:Column(type="string", length="255")
     */
    protected $answer;

    /**
     * @orm:Column(type="integer")
     */
    protected $asked;

    /**
     * @orm:Column(type="integer")
     */
    protected $failed;

    /**
     * @orm:Column(type="integer")
     */
    protected $level;

    /**
     * @orm:Column(type="integer")
     */
    protected $nextSession;

    public function __construct()
    {
      $this->asked = 0;
      $this->failed = 0;
      $this->level = 0;
      $this->nextSession = 0;
    }

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
     * Set question
     *
     * @param string $question
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    }

    /**
     * Get question
     *
     * @return string $question
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * Set answer
     *
     * @param string $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }

    /**
     * Get answer
     *
     * @return string $answer
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set asked
     *
     * @param integer $asked
     */
    public function setAsked($asked)
    {
        $this->asked = $asked;
    }

    /**
     * Get asked
     *
     * @return integer $asked
     */
    public function getAsked()
    {
        return $this->asked;
    }

    /**
     * Set failed
     *
     * @param integer $failed
     */
    public function setFailed($failed)
    {
        $this->failed = $failed;
    }

    /**
     * Get failed
     *
     * @return integer $failed
     */
    public function getFailed()
    {
        return $this->failed;
    }

    /**
     * Set level
     *
     * @param integer $level
     */
    public function setLevel($level)
    {
        $this->level = $level;
    }

    /**
     * Get level
     *
     * @return integer $level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set nextSession
     *
     * @param integer $nextSession
     */
    public function setNextSession($nextSession)
    {
        $this->nextSession = $nextSession;
    }

    /**
     * Get nextSession
     *
     * @return integer $nextSession
     */
    public function getNextSession()
    {
        return $this->nextSession;
    }

    /**
     * Set deck
     *
     * @param Algernon\LeitnerBundle\Entity\Deck $deck
     */
    public function setDeck(\Algernon\LeitnerBundle\Entity\Deck $deck)
    {
        $this->deck = $deck;
    }

    /**
     * Get deck
     *
     * @return Algernon\LeitnerBundle\Entity\Deck $deck
     */
    public function getDeck()
    {
        return $this->deck;
    }
}
