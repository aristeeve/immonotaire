<?php

namespace Partenaire\PartenaireBundle\Controller;

use Partenaire\PartenaireBundle\Entity\Partenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Partenaire controller.
 *
 */
class PartenaireController extends Controller {

    /**
     * Lists all partenaire entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $notification = $em->getRepository('NotificationBundle:Notification')->findBy(array('vu' => 0));
        $partenaires = $em->getRepository('PartenaireBundle:Partenaire')->findAll();

        return $this->render('partenaire/index.html.twig', array(
                    'partenaires' => $partenaires, 'notif' => $notification, 'user' => $user, 'val' => 'partenaire'
        ));
    }

    /**
     * Creates a new partenaire entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $partenaire = new Partenaire();
        $user = $this->getUser();
        $form = $this->createForm('Partenaire\PartenaireBundle\Form\PartenaireType', $partenaire);
        $form->handleRequest($request);
        $notification = $em->getRepository('NotificationBundle:Notification')->findBy(array('vu' => 0));
        if ($form->isSubmitted() && $form->isValid()) {

            if ($partenaire->getLogo()) {

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $partenaire->getLogo();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_partenaire'), $img);
                $partenaire->setLogo($img);
            }


            $em->persist($partenaire);
            $em->flush($partenaire);

            return $this->redirectToRoute('partenaire_show', array('id' => $partenaire->getId()));
        }

        return $this->render('partenaire/new.html.twig', array(
                    'partenaire' => $partenaire,
                    'form' => $form->createView(), 'notif' => $notification, 'user' => $user, 'val' => 'partenaire'
        ));
    }

    /**
     * Finds and displays a partenaire entity.
     *
     */
    public function showAction(Partenaire $partenaire) {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $Partenaire = $em->getRepository("PartenaireBundle:Partenaire")->find($partenaire);
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        return $this->render('Partenaire/show.html.twig', array('partenaire' => $Partenaire
                    , 'notif' => $notif, 'user' => $user, 'val' => 'partenaire'));
    }

    /**
     * Displays a form to edit an existing partenaire entity.
     *
     */
    public function editAction(Request $request, Partenaire $partenaire) {
        $deleteForm = $this->createDeleteForm($partenaire);
        $editForm = $this->createForm('Partenaire\PartenaireBundle\Form\PartenaireType', $partenaire);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $notification = $em->getRepository('NotificationBundle:Notification')->findBy(array('vu' => 0));

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if ($partenaire->getLogo() == null) {
                $partenaire->setLogo($request->get('logo'));
            } else {

                /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
                $file = $partenaire->getLogo();
                $img = md5(uniqid()) . '.' . $file->guessExtension();
                $file->move($this->getParameter('image_partenaire'), $img);
                $partenaire->setLogo($img);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('show-partenaire', array('id' => $partenaire->getId()));
        }

        return $this->render('partenaire/edit.html.twig', array(
                    'partenaire' => $partenaire,
                    'form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
                    'user' => $user,
                    'notif' => $notification,
                    'val' => 'partenaire'
        ));
    }

    /**
     * Deletes a partenaire entity.
     *
     */
    public function deleteAction(Request $request, Partenaire $partenaire) {

        $em = $this->getDoctrine()->getManager();
        $Partenaire = $em->getRepository("PartenaireBundle:Partenaire")->find($partenaire);

        $em->remove($Partenaire);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "Le partenaire a bien été supprimé");

        return $this->redirectToRoute('list-partenaire');
    }

    /**
     * Creates a form to delete a partenaire entity.
     *
     * @param Partenaire $partenaire The partenaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Partenaire $partenaire) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('partenaire_delete', array('id' => $partenaire->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
