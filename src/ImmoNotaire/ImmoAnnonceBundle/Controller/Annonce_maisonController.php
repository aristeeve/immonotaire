<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Notification\NotificationBundle\Entity\Notification;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Media;

/**
 * Annonce_maison controller.
 *
 */
class Annonce_maisonController extends Controller {

    /**
     * Lists all annonce_maison entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $annonce_maisons = $em->getRepository('ImmoAnnonceBundle:Annonce_maison')->findAll();

        return $this->render('annonce_maison/index.html.twig', array(
                    'annonce_maisons' => $annonce_maisons,
        ));
    }

    /**
     * Creates a new annonce_maison entity.
     *
     */
    public function newAction(Request $request) {
        $user = $this->getUser();
        $annonce_maison = new Annonce_maison();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_maisonType', $annonce_maison);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $typebien = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findBy(array('nom' => 'Maison'));
            $annonce_maison->setUser($user);
            $annonce_maison->getAnnonce()->setTypeBiens($typebien[0]);
            $annonce_maison->getAnnonce()->setUser($user);
            $image = "default.png";
            if (!$annonce_maison->getAnnonce()->getMedia()) {
                $media = new Media();
                $media->setFile($image);
                $em->persist($media);
                $annonce_maison->getAnnonce()->setMedia($media);
            } else {
                if ($annonce_maison->getAnnonce()->getMedia()->getFile()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
//die('file1');
                    $file = $annonce_maison->getAnnonce()->getMedia()->getFile();
                    $img = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->getParameter('image_annonce'), $img);
                    $annonce_maison->getAnnonce()->getMedia()->setFile($img);
                }
                if ($annonce_maison->getAnnonce()->getMedia()->getFile1()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
//die('file1');
                    $file1 = $annonce_maison->getAnnonce()->getMedia()->getFile1();
                    $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                    $file1->move($this->getParameter('image_annonce'), $img1);
                    $annonce_maison->getAnnonce()->getMedia()->setFile1($img1);
                }
                if ($annonce_maison->getAnnonce()->getMedia()->getFile2()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                    $file2 = $annonce_maison->getAnnonce()->getMedia()->getFile2();
                    $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                    $file2->move($this->getParameter('image_annonce'), $img2);
                    $annonce_maison->getAnnonce()->getMedia()->setFile2($img2);
                }
                if ($annonce_maison->getAnnonce()->getMedia()->getFile3()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                    $file3 = $annonce_maison->getAnnonce()->getMedia()->getFile3();
                    $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                    $file3->move($this->getParameter('image_annonce'), $img3);
                    $annonce_maison->getAnnonce()->getMedia()->setFile3($img3);
                }
                if ($annonce_maison->getAnnonce()->getMedia()->getFile4()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                    $file4 = $annonce_maison->getAnnonce()->getMedia()->getFile4();
                    $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                    $file4->move($this->getParameter('image_annonce'), $img4);
                    $annonce_maison->getAnnonce()->getMedia()->setFile4($img4);
                }
            }



            $em->persist($annonce_maison);
            $ajout = new Notification();
            $ajout->setType("maison");
            $ajout->setAction("creation");
            $ajout->setUser($user);

            $em->persist($ajout);
            $em->flush();

            $session = new Session();
            $session->getFlashBag()->add('info', "L'annonce a bien été publié");


            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_maison/new.html.twig', array('user' => $user,
                    'annonce_maison' => $annonce_maison, 'pubs' => $pubs,
                    'form' => $form->createView(), 'bien' => 'une maison'
        ));
    }

    /**
     * Finds and displays a annonce_maison entity.
     *
     */
    public function showAction(Annonce_maison $annonce_maison) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_maison);

        return $this->render('annonce_maison/show.html.twig', array('user' => $user,
                    'annonce_maison' => $annonce_maison,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce_maison entity.
     *
     */
    public function editAction(Request $request, Annonce_maison $annonce_maison) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_maison);
        $editForm = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_maisonType', $annonce_maison);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();

// var_dump($annonce);
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            if ($annonce_maison->getAnnonce()->getMedia()->getFile() == null) {
                $annonce_maison->getAnnonce()->getMedia()->setFile($request->get('file'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
//die('file1');
                $file = $annonce_maison->getAnnonce()->getMedia()->getFile();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_annonce'), $img);
                $annonce_maison->getAnnonce()->getMedia()->setFile($img);
            }
            if ($annonce_maison->getAnnonce()->getMedia()->getFile1() == null) {
                $annonce_maison->getAnnonce()->getMedia()->setFile1($request->get('file1'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
//die('file1');
                $file1 = $annonce_maison->getAnnonce()->getMedia()->getFile1();
                $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter('image_annonce'), $img1);
                $annonce_maison->getAnnonce()->getMedia()->setFile1($img1);
            }
            if ($annonce_maison->getAnnonce()->getMedia()->getFile2() == null) {
                $annonce_maison->getAnnonce()->getMedia()->setFile2($request->get('file2'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                $file2 = $annonce_maison->getAnnonce()->getMedia()->getFile2();
                $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter('image_annonce'), $img2);
                $annonce_maison->getAnnonce()->getMedia()->setFile2($img2);
            }
            if ($annonce_maison->getAnnonce()->getMedia()->getFile3() == null) {
                $annonce_maison->getAnnonce()->getMedia()->setFile3($request->get('file3'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                $file3 = $annonce_maison->getAnnonce()->getMedia()->getFile3();
                $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter('image_annonce'), $img3);
                $annonce_maison->getAnnonce()->getMedia()->setFile3($img3);
            }
            if ($annonce_maison->getAnnonce()->getMedia()->getFile4() == null) {
                $annonce_maison->getAnnonce()->getMedia()->setFile4($request->get('file4'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                $file4 = $annonce_maison->getAnnonce()->getMedia()->getFile4();
                $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                $file4->move($this->getParameter('image_annonce'), $img4);
                $annonce_maison->getAnnonce()->getMedia()->setFile4($img4);
            }

            $em->flush();
            $modif = new Notification();
            $modif->setType("maison");
            $modif->setAction("modification");
            $modif->setUser($user);
            $em->persist($modif);
            $em->flush();
            $session = new session();
            $session->getFlashBag()->add('info', "L'annonce a bien été modifié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_maison/edit.html.twig', array(
                    'annonce_maison' => $annonce_maison,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'user' => $user,
                    'pubs' => $pubs,
        ));
    }

    /**
     * Deletes a annonce_maison entity.
     *
     */
    public function deleteAction(Request $request, Annonce_maison $annonce_maison) {
        $form = $this->createDeleteForm($annonce_maison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce_maison);
            $em->flush($annonce_maison);
        }

        return $this->redirectToRoute('annonce_maison_index');
    }

    /**
     * Creates a form to delete a annonce_maison entity.
     *
     * @param Annonce_maison $annonce_maison The annonce_maison entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce_maison $annonce_maison) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('annonce_maison_delete', array('id' => $annonce_maison->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
