<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Notification\NotificationBundle\Entity\Notification;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\RechercheType');
        $form->handleRequest($request);

        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('active' => 1, 'supprimer' => 0), array('id' => "DESC"));

        $recente = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('active' => 1, 'supprimer' => 0), array('id' => "DESC"), 6);

        $plusVue = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('active' => 1, 'supprimer' => 0), array('vue' => "DESC"), 30);

        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();


        return $this->render('ImmoAnnonceBundle:Default:index.html.twig', array(
                    'user' => $user,
                    'pubs' => $pubs,
                    'form' => $form->createView(),
                    'annonces' => $annonce, 'recentes' => $recente, 'vues' => $plusVue));
    }

    public function ListeAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonces = $em->getRepository("ImmoAnnonceBundle:Annonce")->findby(array('active' => 1, 'supprimer' => 0));
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\RechercheType');
        $form->handleRequest($request);
        $pubs= $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($annonces, $request->query->get('page', 1), 3);

        return $this->render('ImmoAnnonceBundle:Default:liste.html.twig', array(
                    'page' => $pagination,
                    'user' => $user,'pubs'=>$pubs,
                    'form' => $form->createView(),
                    'annonces' => $annonces
        ));
    }

    public function rechercherAnnonceAction(Request $request) {

        $user = $this->getUser();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\RechercheType');
        $form->handleRequest($request);
         $em = $this->getDoctrine()->getManager();
        $pubs= $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $recherche = $this->selectParameter($request);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($recherche, $request->query->get('page', 1), 3);

        return $this->render('ImmoAnnonceBundle:Default:recherche.html.twig', array(
                    'user' => $user,
                    'bien' => $request->get('type_biens'),
                    'recherches' => $recherche,
                    'page' => $pagination,
                    'pubs'=>$pubs,
                    'form' => $form->createView()
        ));
    }

    public function detailAnnonceAction($annonce, Request $request) {

        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
         $pubs= $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $dejaVu = $request->cookies->has("annonce" . $annonce);

        if (!$dejaVu) {
            $Ann = $em->getRepository("ImmoAnnonceBundle:Annonce")->find($annonce);
            if ($Ann->getUser() != $user) {
                $cookie_info = array(
                    'name' => "annonce" . $annonce,
                    'value' => $Ann->getTitre(),
                    'time' => time() + 86400);

                // Cree le cookie
                $cookie = new Cookie($cookie_info['name'], $cookie_info['value'], $cookie_info['time']);

                // Envoie le cookie
                $response = new Response();
                $response->headers->setCookie($cookie);
                $response->send();


                $vue = $Ann->getVue();

                $Ann->setVue($vue + 1);
                $em->persist($Ann);
                $em->flush();
            }
        }

        $local = $em->getRepository("ImmoAnnonceBundle:Annonce_local")->findBy(array('annonce' => $annonce));
        $appartement = $em->getRepository("ImmoAnnonceBundle:Annonce_appart")->findBy(array('annonce' => $annonce));
        $maison = $em->getRepository("ImmoAnnonceBundle:Annonce_maison")->findBy(array('annonce' => $annonce));
        $terrain = $em->getRepository("ImmoAnnonceBundle:Annonce_terrain")->findBy(array('annonce' => $annonce));

        $annonces = $this->Is_empties($local, $appartement, $maison, $terrain);

        //var_dump($annonce);
        return $this->render('ImmoAnnonceBundle:Default:detail.html.twig', array('user' => $user, 'annonce' => $annonces,'pubs'=>$pubs,));
    }

    public function EnvoiemailAction(Request $request) {
        $user = $this->getUser();
        $nom = $request->get('name');
        $contact = $request->get('contact');
        $email = $request->get('email');
        $sms = $request->get('message');
        $destinataire = $request->get('destinataire');

        $message = \Swift_Message::newInstance()
                ->setSubject('Annonce')
                ->setFrom(array('wisdom@epistrophe.com' => 'Immonotaire.com'))
                ->setTo($destinataire)
                ->setBody($this->renderView('ImmoAnnonceBundle:Default:email.html.twig', array('sms' => $sms,
                            'nom' => $nom,
                            'contact' => $contact,
                            'email' => $email)))
                ->setContentType('text/html');
        $result = $this->get('mailer')->send($message);

//        var_dump($result);
//        die();
        /* return $this->render('ImmoAnnonceBundle:Default:email.html.twig', array('sms' => $sms,
          'nom'=>$nom,
          'contact'=>$contact,
          'email'=>$email)); */

        return $this->redirectToRoute('immo_annonce_homepage');
    }

    public function selectParameter(Request $request) {
        $ville = $request->get('ville'); // la ville biensur
        $typeAppart = $request->get('modeleAppart');
        $typeTerrain = $request->get('modeleTerrain');
        $typeLocal = $request->get('modeleLocal');
        $typeMaison = $request->get('modeleMaison');
        $typeBiens = $request->get('type_biens'); // terrain ou maison ou ...
        $statut = $request->get('statut'); // location ou vente
        $sup = $request->get('superficie'); // la superficie du bien
        $piece = $request->get('piece'); // nbre de piece du bien
        $prix = $request->get('prix');
        $em = $this->getDoctrine()->getManager();
        if ($typeBiens) {
            switch ($typeBiens) {
                case 'Terrain':
                    $param = array();
                    //recupère si c'est à louer ou a vendre
                    $typeAnnonce = $em->getRepository("ImmoAnnonceBundle:Type_annonce")->findOneBy(array('nom' => $statut));
                    $param['type_annonce'] = $typeAnnonce;
                    $param['ville'] = $ville;
                    // recupère l'objet terrain
                    $terrain = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findOneBy(array('nom' => 'Terrain'));
                    $param['type_biens'] = $terrain;

                    if ($typeTerrain) {
                        $typeterrain = $em->getRepository("ImmoAnnonceBundle:Type_terrain")->findOneBy(array('nom' => $typeTerrain));
                        $param['type_terrain'] = $typeterrain->getId();
                    }
                    $param['piece'] = $piece;
                    $param['superficie'] = $sup;
                    $param['prix'] = $prix;

                    $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce_terrain")->rechercheTerrain($param);


                    break;
                case 'Appartement':
                    $param = array();
                    //recupère si c'est à louer ou a vendre
                    $typeAnnonce = $em->getRepository("ImmoAnnonceBundle:Type_annonce")->findOneBy(array('nom' => $statut));
                    $param['type_annonce'] = $typeAnnonce->getId();
                    //ville
                    $param['ville'] = $ville;

                    // recupère le type de bien (appartement)
                    $appart = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findOneBy(array('nom' => 'Appartement'));
                    $param['type_biens'] = $appart->getId();

                    //recupère le modele d'appart
                    if ($typeAppart) {
                        $typeappart = $em->getRepository("ImmoAnnonceBundle:Type_appart")->findOneBy(array('nom' => $typeAppart));
                        $param['type_appart'] = $typeappart->getId();
                    }
                    $param['piece'] = $piece;
                    $param['superficie'] = $sup;
                    $param['prix'] = $prix;

                    $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce_appart")->rechercheAppart($param);
                    // var_dump($annonce);
//               
                    break;
                case 'Maison':
                    $param = array();
                    //recupère si c'est à louer ou a vendre
                    $typeAnnonce = $em->getRepository("ImmoAnnonceBundle:Type_annonce")->findOneBy(array('nom' => $statut));
                    $param['type_annonce'] = $typeAnnonce;
                    $param['ville'] = $ville;
                    // recupère l'objet terrain
                    $maison = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findOneBy(array('nom' => 'Maison'));
                    $param['type_biens'] = $maison;

                    if ($typeMaison) {
                        $typemaison = $em->getRepository("ImmoAnnonceBundle:Type_maison")->findOneBy(array('nom' => $typeMaison));
                        $param['type_maison'] = $typemaison->getId();
                    }
                    $param['piece'] = $piece;
                    $param['superficie'] = $sup;
                    $param['prix'] = $prix;

                    $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce_maison")->rechercheMaison($param);

                    break;
                case 'Local Commercial':
                    $param = array();
                    //recupère si c'est à louer ou a vendre
                    $typeAnnonce = $em->getRepository("ImmoAnnonceBundle:Type_annonce")->findOneBy(array('nom' => $statut));
                    $param['type_annonce'] = $typeAnnonce;
                    $param['ville'] = $ville;
                    // recupère l'objet terrain
                    $local = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findOneBy(array('nom' => 'Local Commercial'));
                    $param['type_biens'] = $local;

                    if ($typeLocal) {
                        $typelocal = $em->getRepository("ImmoAnnonceBundle:Type_local")->findOneBy(array('nom' => $typeLocal));
                        $param['type_local'] = $typelocal->getId();
                    }
                    $param['piece'] = $piece;
                    $param['superficie'] = $sup;
                    $param['prix'] = $prix;

                    $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce_local")->rechercheLocal($param);

                    break;
                default:
                    throw new \Exception('Erreur');
                    break;
            }
        } else {
            $typeAnnonce = $em->getRepository("ImmoAnnonceBundle:Type_annonce")->findOneBy(array('nom' => $statut));
            $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('type_annonce' => $typeAnnonce, 'active' => 1, 'supprimer' => 0));
        }

        return $annonce;
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
