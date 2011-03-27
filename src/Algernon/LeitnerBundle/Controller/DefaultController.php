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
        $query = $em->createQuery('SELECT c FROM Algernon\LeitnerBundle\Entity\Card c WHERE c.id IN ( :ids )');
        $query->setParameter('ids', implode(",", $ids));
        $cards = $query->getResult();
        foreach ($cards as $card) {
            $card->setLevel($card->getLevel() +1);
            $em->persist($card);
        }
        $em->flush();
        return new Response('<html><body>Ok</body></html>');
    }
}
