<?php

namespace Algernon\LeitnerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
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

        return array('cards' => $cards);
    }
}
