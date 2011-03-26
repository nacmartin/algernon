<?php

namespace Algernon\LeitnerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Algernon\LeitnerBundle\Entity\Card,
    Algernon\LeitnerBundle\Entity\Deck;

class CardFixtures implements FixtureInterface
{
    public function load($em)
    {
        $deck = new Deck();
        $deck->setName('Deutsch - Español');

        $em->persist($deck);

        $aufwachsen = new Card();
        $aufwachsen->setQuestion('aufwachsen');
        $aufwachsen->setAnswer('crecer');
        $aufwachsen->setDeck($deck);

        $ausbuergern = new Card();
        $ausbuergern->setQuestion('ausbürguern');
        $ausbuergern->setAnswer('crecer');
        $ausbuergern->setDeck($deck);

        $einbüergern = new Card();
        $einbüergern->setQuestion('einbürguern');
        $einbüergern->setAnswer('crecer');
        $einbüergern->setDeck($deck);

        $em->persist($aufwachsen);
        $em->persist($ausbuergern);
        $em->persist($einbüergern);

        $em->flush();
    }
}

