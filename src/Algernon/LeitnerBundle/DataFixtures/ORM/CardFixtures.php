<?php

namespace Algernon\LeitnerBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface,
    Algernon\LeitnerBundle\Entity\Card,
    Algernon\LeitnerBundle\Entity\Deck,
    Algernon\LeitnerBundle\Entity\Session;

class CardFixtures implements FixtureInterface
{
    public function load($em)
    {

        $session = new Session();
        $session->setCurrentSession(0);
        $em->persist($session);

        $deck = new Deck();
        $deck->setName('Deutsch - English');

        $em->persist($deck);

        $row = 1;
        if (($handle = fopen("deutsch-english.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $card = new Card();
                $card->setQuestion($data[0]);
                $card->setAnswer($data[2]);
                $card->setDeck($deck);
                $em->persist($card);
            }
            fclose($handle);
        }

        $em->flush();
    }
}

