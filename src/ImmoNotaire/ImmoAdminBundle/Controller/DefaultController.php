<?php

namespace ImmoNotaire\ImmoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Notification\NotificationBundle\Entity\Notification;

class DefaultController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = count($em->getRepository('ImmoNotaireBundle:User')->findAll());
        $annonce = count($em->getRepository('ImmoAnnonceBundle:Annonce')->findAll());
        $annonceArchive = count($em->getRepository('ImmoAnnonceBundle:Annonce')->findBy(array('active' => 0,'supprimer' => 0)));
        $annonceSupprimer = count($em->getRepository('ImmoAnnonceBundle:Annonce')->findBy(array('supprimer' => 1)));
        $derniereAnnonces = $em->getRepository('ImmoAnnonceBundle:Annonce')->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu'=>0));

        return $this->render('ImmoAdminBundle:Default:index.html.twig', array('user' => $user,
                    'users' => $users,
                    'AnnonceArchiver' => $annonceArchive,
                    'AnnonceSupprimer' => $annonceSupprimer,
                    'nbreAnnonce' => $annonce,
                    'derniereAnnonce' => $derniereAnnonces,
                    'notif' => $notif,'val'=>'dashboard'));
    }

}
