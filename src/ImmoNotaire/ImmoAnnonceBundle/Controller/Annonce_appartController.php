<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_appart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Session\Session;
use Notification\NotificationBundle\Entity\Notification;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Media;

/**
 * Annonce_appart controller.
 *
 */
class Annonce_appartController extends Controller {

    /**
     * Lists all annonce_appart entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $annonce_apparts = $em->getRepository('ImmoAnnonceBundle:Annonce_appart')->findAll();

        return $this->render('annonce_appart/index.html.twig', array(
                    'annonce_apparts' => $annonce_apparts,
        ));
    }

    /**
     * Creates a new annonce_appart entity.
     *
     */
    public function newAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $annonce_appart = new Annonce_appart();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_appartType', $annonce_appart);
        $form->handleRequest($request);
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        if ($form->isSubmitted() && $form->isValid()) {


            $typebien = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findBy(array('nom' => 'Appartement'));
            $annonce_appart->setUser($user);
            $annonce_appart->getAnnonce()->setTypeBiens($typebien[0]);
            $annonce_appart->getAnnonce()->setUser($user);
            $image = "default.png";
            if (!$annonce_appart->getAnnonce()->getMedia()) {
                $media = new Media();
                $media->setFile($image);
                $em->persist($media);
                $annonce_appart->getAnnonce()->setMedia($media);
            } else {
                if ($annonce_appart->getAnnonce()->getMedia()->getFile()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    //die('file1');
                    $file = $annonce_appart->getAnnonce()->getMedia()->getFile();
                    $img = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->getParameter('image_annonce'), $img);
                    $annonce_appart->getAnnonce()->getMedia()->setFile($img);
                }
                if ($annonce_appart->getAnnonce()->getMedia()->getFile1()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                    //die('file1');
                    $file1 = $annonce_appart->getAnnonce()->getMedia()->getFile1();
                    $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                    $file1->move($this->getParameter('image_annonce'), $img1);
                    $annonce_appart->getAnnonce()->getMedia()->setFile1($img1);
                }
                if ($annonce_appart->getAnnonce()->getMedia()->getFile2()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                    $file2 = $annonce_appart->getAnnonce()->getMedia()->getFile2();
                    $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                    $file2->move($this->getParameter('image_annonce'), $img2);
                    $annonce_appart->getAnnonce()->getMedia()->setFile2($img2);
                }
                if ($annonce_appart->getAnnonce()->getMedia()->getFile3()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                    $file3 = $annonce_appart->getAnnonce()->getMedia()->getFile3();
                    $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                    $file3->move($this->getParameter('image_annonce'), $img3);
                    $annonce_appart->getAnnonce()->getMedia()->setFile3($img3);
                }
                if ($annonce_appart->getAnnonce()->getMedia()->getFile4()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                    $file4 = $annonce_appart->getAnnonce()->getMedia()->getFile4();
                    $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                    $file4->move($this->getParameter('image_annonce'), $img4);
                    $annonce_appart->getAnnonce()->getMedia()->setFile4($img4);
                }
            }

            $em->persist($annonce_appart);

            $ajout = new Notification();
            $ajout->setType("appartement");
            $ajout->setAction("creation");
            $ajout->setUser($user);

            $em->persist($ajout);

            $em->flush();
            $session = new Session();
            $session->getFlashBag()->add('info', "L'annonce a bien été publié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_appart/new.html.twig', array(
                    'annonce_appart' => $annonce_appart,
                    'form' => $form->createView(),
                    'user' => $user,
                    'pubs' => $pubs,
                    'bien' => 'un appartement'
        ));
    }

    /**
     * Finds and displays a annonce_appart entity.
     *
     */
    public function showAction(Annonce_appart $annonce_appart) {

        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_appart);

        return $this->render('annonce_appart/show.html.twig', array(
                    'user' => $user,
                    'annonce_appart' => $annonce_appart,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce_appart entity.
     *
     */
    public function editAction(Request $request, Annonce_appart $annonce_appart) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_appart);
        $editForm = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_appartType', $annonce_appart);
        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();

        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        // var_dump($annonce);
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            if ($annonce_appart->getAnnonce()->getMedia()->getFile() == null) {
                $annonce_appart->getAnnonce()->getMedia()->setFile($request->get('file'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                //die('file1');
                $file = $annonce_appart->getAnnonce()->getMedia()->getFile();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_annonce'), $img);
                $annonce_appart->getAnnonce()->getMedia()->setFile($img);
            }
            if ($annonce_appart->getAnnonce()->getMedia()->getFile1() == null) {
                $annonce_appart->getAnnonce()->getMedia()->setFile1($request->get('file1'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                //die('file1');
                $file1 = $annonce_appart->getAnnonce()->getMedia()->getFile1();
                $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter('image_annonce'), $img1);
                $annonce_appart->getAnnonce()->getMedia()->setFile1($img1);
            }
            if ($annonce_appart->getAnnonce()->getMedia()->getFile2() == null) {
                $annonce_appart->getAnnonce()->getMedia()->setFile2($request->get('file2'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                $file2 = $annonce_appart->getAnnonce()->getMedia()->getFile2();
                $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter('image_annonce'), $img2);
                $annonce_appart->getAnnonce()->getMedia()->setFile2($img2);
            }
            if ($annonce_appart->getAnnonce()->getMedia()->getFile3() == null) {
                $annonce_appart->getAnnonce()->getMedia()->setFile3($request->get('file3'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                $file3 = $annonce_appart->getAnnonce()->getMedia()->getFile3();
                $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter('image_annonce'), $img3);
                $annonce_appart->getAnnonce()->getMedia()->setFile3($img3);
            }
            if ($annonce_appart->getAnnonce()->getMedia()->getFile4() == null) {
                $annonce_appart->getAnnonce()->getMedia()->setFile4($request->get('file4'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                $file4 = $annonce_appart->getAnnonce()->getMedia()->getFile4();
                $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                $file4->move($this->getParameter('image_annonce'), $img4);
                $annonce_appart->getAnnonce()->getMedia()->setFile4($img4);
            }

            $em->flush();

            $modif = new Notification();
            $modif->setType("appartement");
            $modif->setAction("modification");
            $modif->setUser($user);

            $em->persist($modif);
            $em->flush();
            $session = new session();
            $session->getFlashBag()->add('info', "L'annonce a bien été modifié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_appart/edit.html.twig', array(
                    'annonce_appart' => $annonce_appart,
                    'form' => $editForm->createView(),
                    'user' => $user,
                    'pubs' => $pubs,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce_appart entity.
     *
     */
    public function deleteAction(Request $request, Annonce_appart $annonce_appart) {
        $form = $this->createDeleteForm($annonce_appart);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce_appart);
            $em->flush($annonce_appart);
        }

        return $this->redirectToRoute('annonce_appart_index');
    }

    /**
     * Creates a form to delete a annonce_appart entity.
     *
     * @param Annonce_appart $annonce_appart The annonce_appart entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce_appart $annonce_appart) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('annonce_appart_delete', array('id' => $annonce_appart->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
