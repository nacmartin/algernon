<?php

namespace Algernon\LeitnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Symfony\Component\HttpFoundation\Response,
    Algernon\LeitnerBundle\Entity;

class DefaultController extends Controller
{
    /**
     * @extra:Route("/", name="_homepage")
     * @extra:Template()
     */

    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT u FROM Algernon\LeitnerBundle\Entity\Session u');
        $currentSession = $query->getSingleResult();
        $cs = $currentSession->getCurrentSession();

        $query = $em->createQuery('SELECT c FROM Algernon\LeitnerBundle\Entity\Card c WHERE c.nextSession = :session OR c.level = 0' );
        $query->setParameter('session', $cs);
        $cards = $query->getArrayResult();

        return array('cards' => $cards, 'session' => $cs);
    }

    public function answeredAction($card_id)
    {
        $card = $entityManager->find('Algernon\LeitnerBundle\Entity\Card', $card_id);
        if (!$card) {
            throw new NotFoundHttpException('The card does not exist.');
        }
    }

    /**
     * @extra:Route("/upgrade", name="_upgrade")
     * @extra:Template()
     */

    public function upgrade()
    {
        $request = $this->get('request');
        $card_ids = $request->query->get('card_ids');
        $ids = json_decode($card_ids);
        $em = $this->get('doctrine.orm.entity_manager');
        $query = $em->createQuery('SELECT c FROM Algernon\LeitnerBundle\Entity\Card c WHERE c.id IN ( '.implode(",", $ids).' )');

        $cards = $query->getResult();
        foreach ($cards as $card) {
            $card->setLevel($card->getLevel() +1);
            print_r($card->getId());
            $em->persist($card);
        }
        $em->flush();
        return new Response('<html><body>Ok</body></html>');
    }

    /**
     * @extra:Route("/right", name="_right")
     * @extra:Template()
     */

    public function right()
    {
        $request = $this->get('request');
        $card_id = $request->query->get('id');
        $em = $this->get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT u FROM Algernon\LeitnerBundle\Entity\Session u');
        $currentSession = $query->getSingleResult();
        $cs = $currentSession->getCurrentSession();

        $card = $em->find('Algernon\LeitnerBundle\Entity\Card', $card_id);
        $card->setLevel($card->getLevel() + 1);
        $card->setNextSession($cs + $card->getLevel());
        $em->persist($card);
        $em->flush();
        return new Response('<html><body>Ok</body></html>');
    }
    /**
     * @extra:Route("/wrong", name="_wrong")
     * @extra:Template()
     */

    public function wrong()
    {
        $request = $this->get('request');
        $card_id = $request->query->get('id');
        $em = $this->get('doctrine.orm.entity_manager');

        $query = $em->createQuery('SELECT u FROM Algernon\LeitnerBundle\Entity\Session u');
        $currentSession = $query->getSingleResult();
        $cs = $currentSession->getCurrentSession();

        $card = $em->find('Algernon\LeitnerBundle\Entity\Card', $card_id);
        $card->setLevel(1);
        $card->setNextSession($cs);
        $em->persist($card);
        $em->flush();
        return new Response('<html><body>Ok</body></html>');
    }
    /**
     * @extra:Route("/end-session", name="endSession")
     * @extra:Template()
     */

    public function endSession()
    {
    }
}
