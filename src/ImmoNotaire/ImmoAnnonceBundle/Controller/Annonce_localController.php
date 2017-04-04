<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_local;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Notification\NotificationBundle\Entity\Notification;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Media;

/**
 * Annonce_local controller.
 *
 */
class Annonce_localController extends Controller {

    /**
     * Lists all annonce_local entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $annonce_locals = $em->getRepository('ImmoAnnonceBundle:Annonce_local')->findAll();

        return $this->render('annonce_local/index.html.twig', array(
                    'annonce_locals' => $annonce_locals,
        ));
    }

    /**
     * Creates a new annonce_local entity.
     *
     */
    public function newAction(Request $request) {
        $user = $this->getUser();
        $annonce_local = new Annonce_local();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_localType', $annonce_local);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        if ($form->isSubmitted() && $form->isValid()) {

            $typebien = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findBy(array('nom' => 'Local commercial'));
            $annonce_local->setUser($user);
            $annonce_local->getAnnonce()->setTypeBiens($typebien[0]);
            $annonce_local->getAnnonce()->setUser($user);
            $image = "default.png";
            if (!$annonce_local->getAnnonce()->getMedia()) {
                $media = new Media();
                $media->setFile($image);
                $em->persist($media);
                $annonce_local->getAnnonce()->setMedia($media);
            } else {
                if ($annonce_local->getAnnonce()->getMedia()->getFile()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    //die('file1');
                    $file = $annonce_local->getAnnonce()->getMedia()->getFile();
                    $img = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->getParameter('image_annonce'), $img);
                    $annonce_local->getAnnonce()->getMedia()->setFile($img);
                }
                if ($annonce_local->getAnnonce()->getMedia()->getFile1()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                    //die('file1');
                    $file1 = $annonce_local->getAnnonce()->getMedia()->getFile1();
                    $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                    $file1->move($this->getParameter('image_annonce'), $img1);
                    $annonce_local->getAnnonce()->getMedia()->setFile1($img1);
                }
                if ($annonce_local->getAnnonce()->getMedia()->getFile2()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                    $file2 = $annonce_local->getAnnonce()->getMedia()->getFile2();
                    $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                    $file2->move($this->getParameter('image_annonce'), $img2);
                    $annonce_local->getAnnonce()->getMedia()->setFile2($img2);
                }
                if ($annonce_local->getAnnonce()->getMedia()->getFile3()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                    $file3 = $annonce_local->getAnnonce()->getMedia()->getFile3();
                    $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                    $file3->move($this->getParameter('image_annonce'), $img3);
                    $annonce_local->getAnnonce()->getMedia()->setFile3($img3);
                }
                if ($annonce_local->getAnnonce()->getMedia()->getFile4()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                    $file4 = $annonce_local->getAnnonce()->getMedia()->getFile4();
                    $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                    $file4->move($this->getParameter('image_annonce'), $img4);
                    $annonce_local->getAnnonce()->getMedia()->setFile4($img4);
                }
            }

            $em->persist($annonce_local);

            $ajout = new Notification();
            $ajout->setType("local commercial");
            $ajout->setAction("creation");
            $ajout->setUser($user);

            $em->persist($ajout);
            $em->flush();

            $session = new Session();
            $session->getFlashBag()->add('info', "L'annonce a bien été publié");


            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_local/new.html.twig', array(
                    'user' => $user,'pubs' => $pubs,
                    'annonce_local' => $annonce_local,
                    'form' => $form->createView(), 'bien' => 'un local'
        ));
    }

    /**
     * Finds and displays a annonce_local entity.
     *
     */
    public function showAction(Annonce_local $annonce_local) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_local);

        return $this->render('annonce_local/show.html.twig', array('user' => $user,
                    'annonce_local' => $annonce_local,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce_local entity.
     *
     */
    public function editAction(Request $request, Annonce_local $annonce_local) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_local);
        $editForm = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_localType', $annonce_local);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();

        // var_dump($annonce);
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            if ($annonce_local->getAnnonce()->getMedia()->getFile() == null) {
                $annonce_local->getAnnonce()->getMedia()->setFile($request->get('file'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                //die('file1');
                $file = $annonce_local->getAnnonce()->getMedia()->getFile();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_annonce'), $img);
                $annonce_local->getAnnonce()->getMedia()->setFile($img);
            }
            if ($annonce_local->getAnnonce()->getMedia()->getFile1() == null) {
                $annonce_local->getAnnonce()->getMedia()->setFile1($request->get('file1'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                //die('file1');
                $file1 = $annonce_local->getAnnonce()->getMedia()->getFile1();
                $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter('image_annonce'), $img1);
                $annonce_local->getAnnonce()->getMedia()->setFile1($img1);
            }
            if ($annonce_local->getAnnonce()->getMedia()->getFile2() == null) {
                $annonce_local->getAnnonce()->getMedia()->setFile2($request->get('file2'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                $file2 = $annonce_local->getAnnonce()->getMedia()->getFile2();
                $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter('image_annonce'), $img2);
                $annonce_local->getAnnonce()->getMedia()->setFile2($img2);
            }
            if ($annonce_local->getAnnonce()->getMedia()->getFile3() == null) {
                $annonce_local->getAnnonce()->getMedia()->setFile3($request->get('file3'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                $file3 = $annonce_local->getAnnonce()->getMedia()->getFile3();
                $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter('image_annonce'), $img3);
                $annonce_local->getAnnonce()->getMedia()->setFile3($img3);
            }
            if ($annonce_local->getAnnonce()->getMedia()->getFile4() == null) {
                $annonce_local->getAnnonce()->getMedia()->setFile4($request->get('file4'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                $file4 = $annonce_local->getAnnonce()->getMedia()->getFile4();
                $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                $file4->move($this->getParameter('image_annonce'), $img4);
                $annonce_local->getAnnonce()->getMedia()->setFile4($img4);
            }

            $em->flush();

            $modif = new Notification();
            $modif->setType("local commercial");
            $modif->setAction("modification");
            $modif->setUser($user);
            $em->persist($modif);
            $em->flush();
            $session = new session();
            $session->getFlashBag()->add('info', "L'annonce a bien été modifié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_local/edit.html.twig', array(
                    'annonce_local' => $annonce_local,
                    'form' => $editForm->createView(),
                    'user' => $user,'pubs' => $pubs,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce_local entity.
     *
     */
    public function deleteAction(Request $request, Annonce_local $annonce_local) {
        $form = $this->createDeleteForm($annonce_local);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce_local);
            $em->flush($annonce_local);
        }

        return $this->redirectToRoute('annonce_local_index');
    }

    /**
     * Creates a form to delete a annonce_local entity.
     *
     * @param Annonce_local $annonce_local The annonce_local entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce_local $annonce_local) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('annonce_local_delete', array('id' => $annonce_local->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
