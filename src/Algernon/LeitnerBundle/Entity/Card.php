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
     * @orm:Column(type="string", length="255", nullable=true)
     */
    protected $answer;

    public function __construct()
    {
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