<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Regions;

class AnnonceController extends Controller {

    public function indexAction() {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('active' => 1, 'supprimer' => 0));
        $pubs= $em->getRepository("PubliciteBundle:Publicite")->findAll();
        return $this->render('ImmoAnnonceBundle:Default:index.html.twig', array(
                    'user' => $user, 'annonces' => $annonce,'pubs' => $pubs));
    }

    public function choixAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $pubs= $em->getRepository("PubliciteBundle:Publicite")->findAll();
        return $this->render('ImmoAnnonceBundle:Annonce:index.html.twig', array(
                    'user' => $user,'pubs' => $pubs
        ));
    }

}
