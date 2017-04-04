<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Controller;

use ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_terrain;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Notification\NotificationBundle\Entity\Notification;
use ImmoNotaire\ImmoAnnonceBundle\Entity\Media;

/**
 * Annonce_terrain controller.
 *
 */
class Annonce_terrainController extends Controller {

    /**
     * Lists all annonce_terrain entities.
     *
     */
    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $annonce_terrains = $em->getRepository('ImmoAnnonceBundle:Annonce_terrain')->findAll();

        return $this->render('annonce_terrain/index.html.twig', array('user' => $user,
                    'annonce_terrains' => $annonce_terrains,
        ));
    }

    /**
     * Creates a new annonce_terrain entity.
     *
     */
    public function newAction(Request $request) {
        $user = $this->getUser();
        $annonce_terrain = new Annonce_terrain();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_terrainType', $annonce_terrain);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        if ($form->isSubmitted() && $form->isValid()) {


            $typebien = $em->getRepository("ImmoAnnonceBundle:Type_biens")->findBy(array('nom' => 'Terrain'));
            $annonce_terrain->setUser($user);
            $annonce_terrain->getAnnonce()->setTypeBiens($typebien[0]);
            $annonce_terrain->getAnnonce()->setUser($user);
            $image = "default.png";
            if (!$annonce_terrain->getAnnonce()->getMedia()) {
                $media = new Media();
                $media->setFile($image);
                $em->persist($media);
                $annonce_terrain->getAnnonce()->setMedia($media);
            } else {
                if ($annonce_terrain->getAnnonce()->getMedia()->getFile()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                    //die('file1');
                    $file = $annonce_terrain->getAnnonce()->getMedia()->getFile();
                    $img = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->getParameter('image_annonce'), $img);
                    $annonce_terrain->getAnnonce()->getMedia()->setFile($img);
                }
                if ($annonce_terrain->getAnnonce()->getMedia()->getFile1()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                    //die('file1');
                    $file1 = $annonce_terrain->getAnnonce()->getMedia()->getFile1();
                    $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                    $file1->move($this->getParameter('image_annonce'), $img1);
                    $annonce_terrain->getAnnonce()->getMedia()->setFile1($img1);
                }
                if ($annonce_terrain->getAnnonce()->getMedia()->getFile2()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                    $file2 = $annonce_terrain->getAnnonce()->getMedia()->getFile2();
                    $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                    $file2->move($this->getParameter('image_annonce'), $img2);
                    $annonce_terrain->getAnnonce()->getMedia()->setFile2($img2);
                }
                if ($annonce_terrain->getAnnonce()->getMedia()->getFile3()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                    $file3 = $annonce_terrain->getAnnonce()->getMedia()->getFile3();
                    $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                    $file3->move($this->getParameter('image_annonce'), $img3);
                    $annonce_terrain->getAnnonce()->getMedia()->setFile3($img3);
                }
                if ($annonce_terrain->getAnnonce()->getMedia()->getFile4()) {
                    /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                    $file4 = $annonce_terrain->getAnnonce()->getMedia()->getFile4();
                    $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                    $file4->move($this->getParameter('image_annonce'), $img4);
                    $annonce_terrain->getAnnonce()->getMedia()->setFile4($img4);
                }
            }

            $em->persist($annonce_terrain);
            $ajout = new Notification();
            $ajout->setType("terrain");
            $ajout->setAction("creation");
            $ajout->setUser($user);

            $em->persist($ajout);
            $em->flush();
            $session = new Session();
            $session->getFlashBag()->add('info', "L'annonce a bien été publié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_terrain/new.html.twig', array('user' => $user,
                    'annonce_terrain' => $annonce_terrain, 'pubs' => $pubs,
                    'form' => $form->createView(), 'bien' => 'un terrain'
        ));
    }

    /**
     * Finds and displays a annonce_terrain entity.
     *
     */
    public function showAction(Annonce_terrain $annonce_terrain) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_terrain);

        return $this->render('annonce_terrain/show.html.twig', array('user' => $user,
                    'annonce_terrain' => $annonce_terrain,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing annonce_terrain entity.
     *
     */
    public function editAction(Request $request, Annonce_terrain $annonce_terrain) {
        $user = $this->getUser();
        $deleteForm = $this->createDeleteForm($annonce_terrain);
        $editForm = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\Annonce_terrainType', $annonce_terrain);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        // var_dump($annonce);
        if ($editForm->isSubmitted() && $editForm->isValid()) {


            if ($annonce_terrain->getAnnonce()->getMedia()->getFile() == null) {
                $annonce_terrain->getAnnonce()->getMedia()->setFile($request->get('file'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                //die('file1');
                $file = $annonce_terrain->getAnnonce()->getMedia()->getFile();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_annonce'), $img);
                $annonce_terrain->getAnnonce()->getMedia()->setFile($img);
            }
            if ($annonce_terrain->getAnnonce()->getMedia()->getFile1() == null) {
                $annonce_terrain->getAnnonce()->getMedia()->setFile1($request->get('file1'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file1 */
                //die('file1');
                $file1 = $annonce_terrain->getAnnonce()->getMedia()->getFile1();
                $img1 = md5(uniqid()) . '.' . $file1->guessExtension();
                $file1->move($this->getParameter('image_annonce'), $img1);
                $annonce_terrain->getAnnonce()->getMedia()->setFile1($img1);
            }
            if ($annonce_terrain->getAnnonce()->getMedia()->getFile2() == null) {
                $annonce_terrain->getAnnonce()->getMedia()->setFile2($request->get('file2'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file2 */
                $file2 = $annonce_terrain->getAnnonce()->getMedia()->getFile2();
                $img2 = md5(uniqid()) . '.' . $file2->guessExtension();
                $file2->move($this->getParameter('image_annonce'), $img2);
                $annonce_terrain->getAnnonce()->getMedia()->setFile2($img2);
            }
            if ($annonce_terrain->getAnnonce()->getMedia()->getFile3() == null) {
                $annonce_terrain->getAnnonce()->getMedia()->setFile3($request->get('file3'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file3 */
                $file3 = $annonce_terrain->getAnnonce()->getMedia()->getFile3();
                $img3 = md5(uniqid()) . '.' . $file3->guessExtension();
                $file3->move($this->getParameter('image_annonce'), $img3);
                $annonce_terrain->getAnnonce()->getMedia()->setFile3($img3);
            }
            if ($annonce_terrain->getAnnonce()->getMedia()->getFile4() == null) {
                $annonce_terrain->getAnnonce()->getMedia()->setFile4($request->get('file4'));
            } else {
                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file4 */
                $file4 = $annonce_terrain->getAnnonce()->getMedia()->getFile4();
                $img4 = md5(uniqid()) . '.' . $file4->guessExtension();
                $file4->move($this->getParameter('image_annonce'), $img4);
                $annonce_terrain->getAnnonce()->getMedia()->setFile4($img4);
            }

            $em->flush();

            $modif = new Notification();
            $modif->setType("terrain");
            $modif->setAction("modification");
            $modif->setUser($user);
            $em->persist($modif);
            $em->flush();
            $session = new session();
            $session->getFlashBag()->add('info', "L'annonce a bien été modifié");

            return $this->redirectToRoute('immo_notaire_self_annonce_archive');
        }

        return $this->render('annonce_terrain/edit.html.twig', array(
                    'user' => $user, 'pubs' => $pubs,
                    'annonce_terrain' => $annonce_terrain,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a annonce_terrain entity.
     *
     */
    public function deleteAction(Request $request, Annonce_terrain $annonce_terrain) {
        $form = $this->createDeleteForm($annonce_terrain);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($annonce_terrain);
            $em->flush($annonce_terrain);
        }

        return $this->redirectToRoute('annonce_terrain_index');
    }

    /**
     * Creates a form to delete a annonce_terrain entity.
     *
     * @param Annonce_terrain $annonce_terrain The annonce_terrain entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Annonce_terrain $annonce_terrain) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('annonce_terrain_delete', array('id' => $annonce_terrain->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
