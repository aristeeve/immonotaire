<?php

namespace ImmoNotaire\ImmoNotaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Notification\NotificationBundle\Entity\Notification;

class DefaultController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        return $this->render('ImmoNotaireBundle:Default:index.html.twig', array(
                    'user' => $user, 'pubs' => $pubs));
    }

    public function selfAnnonceArchiveAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        //pour les annonces
        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('user' => $user, 'active' => 1), array('id' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($annonce, $request->query->get('page', 1), 10);

        // pour les archives
        $archive = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('user' => $user, 'active' => 0, 'supprimer' => 0), array('id' => 'DESC'));
        $archivator = $this->get('knp_paginator');
        $archivage = $archivator->paginate($archive, $request->query->get('page', 1), 10);


        return $this->render('ImmoNotaireBundle:Default:Self_annonce_archive.html.twig', array(
                    'user' => $user,
                    'annonces' => $annonce,
                    'page' => $pagination,
                    'archives' => $archive,
                    'archivage' => $archivage,
                    'pubs' => $pubs
        ));
    }

    public function redirectUpdateAction($annonce) {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $local = $em->getRepository("ImmoAnnonceBundle:Annonce_local")->findOneBy(array('annonce' => $annonce));
        $appartement = $em->getRepository("ImmoAnnonceBundle:Annonce_appart")->findOneBy(array('annonce' => $annonce));
        $maison = $em->getRepository("ImmoAnnonceBundle:Annonce_maison")->findOneBy(array('annonce' => $annonce));
        $terrain = $em->getRepository("ImmoAnnonceBundle:Annonce_terrain")->findOneBy(array('annonce' => $annonce));


        $result = $this->Is_Editable($local, $appartement, $maison, $terrain);

        return $result;

//return $this->render('ImmoAnnonceBundle:Default:detail.html.twig', array('user' => $user, 'annonce' => $annonce));
    }

    public function archiverAction($annonce) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $Annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->find($annonce);

        $Annonce->setActive(0);

        $url = $this->generateUrl('immo_notaire_self_annonce_archive');

        $archive = new Notification();
        $type = $Annonce->getTypeBiens();

        switch ($type->getNom()) {
            case "Appartement":
                $archive->setType("appartement");
                break;
            case "Terrain":
                $archive->setType("terrain");
                break;
            case "Maison":
                $archive->setType("maison");
                break;
            case "Local Commercial":
                $archive->setType("local commercial");
                break;
        }

        $archive->setAction("archiver");
        $archive->setUser($user);

        $em->persist($archive);
        $em->persist($Annonce);

        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'annonce a bien été archivé");

        $response = new RedirectResponse($url);

        return $response;
    }

    public function restaurerAction($annonce) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $Annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->find($annonce);

        $Annonce->setActive(1);
        $em->persist($Annonce);
        $restaurer = new Notification();
        $type = $Annonce->getTypeBiens();
        switch ($type->getNom()) {
            case "Appartement":
                $restaurer->setType("appartement");
                break;
            case "Terrain":
                $restaurer->setType("terrain");
                break;
            case "Maison":
                $restaurer->setType("maison");
                break;
            case "Local Commercial":
                $restaurer->setType("local commercial");
                break;
        }
        $restaurer->setAction("restauration");
        $restaurer->setUser($user);
        $em->persist($restaurer);


        $em->flush();

        $url = $this->generateUrl('immo_notaire_self_annonce_archive');
        $session = new Session();
        $session->getFlashBag()->add('info', "L'annonce a bien été restauré");
        $response = new RedirectResponse($url);

        return $response;
    }

    public function DeleteAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $annonce = $request->get('name');
        $Annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->find($annonce);

        $Annonce->setSupprimer(1);


        $supprimer = new Notification();
        $type = $Annonce->getTypeBiens();
        switch ($type->getNom()) {
            case "Appartement":
                $supprimer->setType("appartement");
                break;
            case "Terrain":
                $supprimer->setType("terrain");
                break;
            case "Maison":
                $supprimer->setType("maison");
                break;
            case "Local Commercial":
                $supprimer->setType("local commercial");
                break;
        }
        $supprimer->setAction("Suppression");
        $supprimer->setUser($user);
        $em->persist($supprimer);
        $em->persist($Annonce);
        $em->flush();

        $url = $this->generateUrl('immo_notaire_self_annonce_archive');
        $session = new Session();
        $session->getFlashBag()->add('info', "L'annonce a bien été supprimé");
        $response = new RedirectResponse($url);

        return $response;
    }

    public function Is_Deletable($local = null, $appartement = null, $maison = null, $terrain = null) {
        $em = $this->getDoctrine()->getManager();
        if (!empty($local)) {

            $em->remove($local);
            $em->flush($local);
        }
        if (!empty($appartement)) {

            $em->remove($appartement);
            $em->flush($appartement);
        }
        if (!empty($maison)) {
            $em->remove($maison);
            $em->flush($maison);
        }
        if (!empty($terrain)) {
            $em->remove($terrain);
            $em->flush($terrain);
        }
        $this->get('session')->getFlashBag('supprimer', 'suppression effectué.');

        return $this->redirectToRoute('immo_notaire_self_annonce');
    }

    public function Is_Editable($local, $appartement, $maison, $terrain) {
        if (!empty($local)) {
            return $this->redirectToRoute('annonce_local_edit', array('id' => $local->getId()));
        }
        if (!empty($appartement)) {
            return $this->redirectToRoute('annonce_appart_edit', array('id' => $appartement->getId()));
        }
        if (!empty($maison)) {
            return $this->redirectToRoute('annonce_maison_edit', array('id' => $maison->getId()));
        }
        if (!empty($terrain)) {
            return $this->redirectToRoute('annonce_terrain_edit', array('id' => $terrain->getId()));
        }
    }

}
