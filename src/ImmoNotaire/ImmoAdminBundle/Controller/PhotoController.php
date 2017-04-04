<?php

namespace Galerie\GalerieBundle\Controller;

use Galerie\GalerieBundle\Entity\Photo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Photo controller.
 *
 */
class PhotoController extends Controller {

    /**
     * Lists all photo entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $photos = $em->getRepository('ImmoAnnonceBundle:Photo')->findAll();

        return $this->render('photo/index.html.twig', array(
                    'photos' => $photos,
        ));
    }

    /**
     * Creates a new photo entity.
     *
     */
    public function newAction(Request $request) {
        $photo = new Photo();
        $form = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\PhotoType', $photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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

    /**
     * Finds and displays a photo entity.
     *
     */
    public function showAction(Photo $photo) {
        $deleteForm = $this->createDeleteForm($photo);

        return $this->render('photo/show.html.twig', array(
                    'photo' => $photo,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing photo entity.
     *
     */
    public function editAction(Request $request, Photo $photo) {
        $deleteForm = $this->createDeleteForm($photo);
        $editForm = $this->createForm('ImmoNotaire\ImmoAnnonceBundle\Form\PhotoType', $photo);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('photo_edit', array('id' => $photo->getId()));
        }

        return $this->render('photo/edit.html.twig', array(
                    'photo' => $photo,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a photo entity.
     *
     */
    public function deleteAction(Request $request, Photo $photo) {
        $form = $this->createDeleteForm($photo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($photo);
            $em->flush($photo);
        }

        return $this->redirectToRoute('photo_index');
    }

    /**
     * Creates a form to delete a photo entity.
     *
     * @param Photo $photo The photo entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Photo $photo) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('photo_delete', array('id' => $photo->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
