<?php

namespace ImmoNotaire\ImmoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Notification\NotificationBundle\Entity\Notification;

class AnnonceController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('ImmoAnnonceBundle:Annonce')->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu'=>0));
        return $this->render('ImmoAdminBundle:Annonce:Liste_Annonce.html.twig', array('user' => $user,
                    'annonces' => $annonce,'notif'=>$notif,'val'=>'annonce'
        ));
    }

    public function archiverAction($id) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('ImmoAnnonceBundle:Annonce')->find($id);
        $annonce->setActive(0);
        $em->persist($annonce);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('succes', "L'annonce a bien été archivé");

        return $this->redirectToRoute('immo_admin_annonce');
    }

    public function supprimerAction($id) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('ImmoAnnonceBundle:Annonce')->find($id);
        $annonce->setActive(0);
        $annonce->setSupprimer(1);
        $em->persist($annonce);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('succes', "L'annonce a bien été supprimé");

        return $this->redirectToRoute('immo_admin_annonce');
    }

    public function visualiserAction($id) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $local = $em->getRepository("ImmoAnnonceBundle:Annonce_local")->findBy(array('annonce' => $id));
        $appartement = $em->getRepository("ImmoAnnonceBundle:Annonce_appart")->findBy(array('annonce' => $id));
        $maison = $em->getRepository("ImmoAnnonceBundle:Annonce_maison")->findBy(array('annonce' => $id));
        $terrain = $em->getRepository("ImmoAnnonceBundle:Annonce_terrain")->findBy(array('annonce' => $id));

        $annonce = $this->Is_empties($local, $appartement, $maison, $terrain);

        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu'=>0));

        return $this->render('ImmoAdminBundle:Annonce:View_Annonce.html.twig', array('user' => $user,
                    'annonce' => $annonce,'notif'=>$notif,'val'=>'annonce'
        ));
    }

    public function editAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('ImmoAnnonceBundle:Annonce')->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu'=>0));


        return $this->render('ImmoAdminBundle:Annonce:Liste_Annonce.html.twig', array('user' => $user,
                    'annonces' => $annonce,'val'=>'annonce','notif'=>$notif
        ));
    }

    public function restaurationAction($id) {

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository('ImmoAnnonceBundle:Annonce')->find($id);
        $annonce->setSupprimer(0);
        $annonce->setActive(1);
        $em->persist($annonce);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('succes', "L'annonce a bien été restauré");

        return $this->redirectToRoute('immo_admin_annonce');
    }

    public function Is_empties(array $tab1, array $tab2, array $tab3, array $tab4) {
        if (count($tab1) == 0) {
            
        } else {
            return $tab1;
        }
        if (count($tab2) == 0) {
            
        } else {
            return $tab2;
        }
        if (count($tab3) == 0) {
            
        } else {
            return $tab3;
        }
        if (count($tab4) == 0) {
            
        } else {
            return $tab4;
        }
    }

}
