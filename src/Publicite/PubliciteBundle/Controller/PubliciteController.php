<?php

namespace Publicite\PubliciteBundle\Controller;

use Publicite\PubliciteBundle\Entity\Publicite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Publicite controller.
 *
 */
class PubliciteController extends Controller {

    /**
     * Lists all publicite entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $publicites = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        return $this->render('ImmoAdminBundle:Publicite:index.html.twig', array(
                    'publicites' => $publicites, 'pubs' => $pubs, 'notif' => $notif, 'user' => $user, 'val' => "publicite"
        ));
    }

    /**
     * Creates a new publicite entity.
     *
     */
    public function newAction(Request $request) {
        $publicite = new Publicite();
        $user = $this->getUser();
        $form = $this->createForm('Publicite\PubliciteBundle\Form\PubliciteType', $publicite);
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($publicite);
            $em->flush($publicite);

            return $this->redirectToRoute('list_pub');
        }

        return $this->render('ImmoAdminBundle:Publicite:new.html.twig', array(
                    'publicite' => $publicite,
                    'form' => $form->createView(), 'pubs' => $pubs, 'notif' => $notif, 'user' => $user, 'val' => "publicite"
        ));
    }

    /**
     * Finds and displays a publicite entity.
     *
     */
    public function showAction(Publicite $publicite) {
        $deleteForm = $this->createDeleteForm($publicite);

        return $this->render('publicite/show.html.twig', array(
                    'publicite' => $publicite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing publicite entity.
     *
     */
    public function editAction(Request $request, Publicite $publicite) {
        $deleteForm = $this->createDeleteForm($publicite);
        $user = $this->getUser();
        $editForm = $this->createForm('Publicite\PubliciteBundle\Form\PubliciteType', $publicite);
        $editForm->handleRequest($request);
       
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();
            $session = new Session();
            $session->getFlashBag()->add('info', "Le script a bien été modifié");
            return $this->redirectToRoute('list_pub');
        }
        return $this->render('ImmoAdminBundle:Publicite:edit.html.twig', array(
                    'publicite' => $publicite,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(), 'pubs' => $pubs, 'notif' => $notif, 'user' => $user, 'val' => "publicite"
        ));
    }

    /**
     * Deletes a publicite entity.
     *
     */
    public function deleteAction(Request $request, Publicite $publicite) {
        $form = $this->createDeleteForm($publicite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($publicite);
            $em->flush($publicite);
        }

        return $this->redirectToRoute('publicite_index');
    }

    /**
     * Creates a form to delete a publicite entity.
     *
     * @param Publicite $publicite The publicite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Publicite $publicite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('publicite_delete', array('id' => $publicite->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
