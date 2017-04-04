<?php

namespace Galerie\GalerieBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Galerie\GalerieBundle\Entity\Photo;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        $user = $this->getUser();
        $galerie = $em->getRepository("GalerieBundle:Photo")->findAll();
        $photo = new Photo();
        $form = $this->createForm('Galerie\GalerieBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $photo->getImg();
            $filename = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_galerie'), $filename);
            $photo->setImg($filename);

            $em->persist($photo);
            $em->flush($photo);

            return $this->redirectToRoute('list_photo');
        }

        return $this->render('ImmoAdminBundle:Galerie:index.html.twig', array('notif' => $notif,
                    'user' => $user,
                    'val' => 'galerie',
                    'galerie' => $galerie,
                    'form' => $form->createView(),));
    }

    public function newAction(Request $request) {
        $photo = new Photo();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            die('ytest');
            $file = $photo->getImg();
            $fileName = $this->get('Immo_uploader')->upload($file);

            $photo->setImg($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($photo);
            $em->flush($photo);

            return $this->redirectToRoute('photo_show', array('id' => $photo->getId()));
        }

        return $this->render('photo/new.html.twig', array(
                    'photo' => $photo,
                    'form' => $form->createView(),
        ));
    }

}
