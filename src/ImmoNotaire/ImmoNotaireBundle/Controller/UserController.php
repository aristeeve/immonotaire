<?php

namespace ImmoNotaire\ImmoNotaireBundle\Controller;

use ImmoNotaire\ImmoNotaireBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * User controller.
 *
 */
class UserController extends Controller {

    public function RechercheAnnonceNotaireAction(Request $request) {
        
    }

    public function AnnonceNotaireAction(Request $request) {
        $user = $this->getUser();
        $id = $request->get('id');

        $em = $this->getDoctrine()->getManager();
        $u = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        //pour les annonces
        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('user' => $u, 'active' => 1), array('id' => 'DESC'));
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($annonce, $request->query->get('page', 1), 12);
        $pubs = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        return $this->render('ImmoNotaireBundle:Notaire:annonce.html.twig', array(
                    'user' => $user,
                    'notaire' => $u,
                    'pubs' => $pubs,
                    'annonces' => $annonce,
                    'publication' => $pagination,
        ));
    }

    public function rechercheNotaireAction(Request $request) {
        $user = $this->getUser();
        $form = $this->createForm('ImmoNotaire\ImmoNotaireBundle\Form\RechercheNotaireType');
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();

        $repository = $em->getRepository("ImmoNotaireBundle:User");
        $query = $repository->createQueryBuilder('u');

        $query->where($query->expr()->orX($query->expr()->eq('u.enabled', ':val')))
                ->setParameter('val', 1);
        if (!empty($request->get('nom'))) {
            $query->andWhere($query->expr()->orX($query->expr()->eq('u.name', ':nom')))
                    ->setParameter('nom', $request->get('nom'));
        }
        if (!empty($request->get('prenom'))) {
            $query->andWhere($query->expr()->orX($query->expr()->eq('u.username', ':prenom')))
                    ->setParameter('prenom', $request->get('prenom'));
        }
        if (!empty($request->get('ville'))) {
            $query->andWhere($query->expr()->orX($query->expr()->eq('u.ville', ':ville')))
                    ->setParameter('ville', $request->get('ville')); //ville
        }

        $recherche = $query->getQuery()->getResult();
        $pubs = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($recherche, $request->query->get('page', 1), 20);

        return $this->render('ImmoNotaireBundle:Notaire:Annuaire.html.twig', array(
                    'user' => $user,
                    'recherches' => $recherche,
                    'pubs' => $pubs,
                    'notaires' => $pagination,
                    'form' => $form->createView()
        ));
    }

    public function annuaireAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $notaire = $em->getRepository('ImmoNotaireBundle:User')->findAll();
        $form = $this->createForm('ImmoNotaire\ImmoNotaireBundle\Form\RechercheNotaireType');
        $pubs = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate($notaire, $request->query->get('page', 1), 20);

        return $this->render('ImmoNotaireBundle:Notaire:Annuaire.html.twig', array(
                    'notaires' => $pagination,
                    'user' => $user,
                    'pubs' => $pubs,
                    'form' => $form->createView()
        ));
    }

    public function ficheNotaireAction(Request $request) {
        $user = $this->getUser();
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $notaire = $em->getRepository('ImmoNotaireBundle:User')->find($id);
        $form = $this->createForm('ImmoNotaire\ImmoNotaireBundle\Form\RechercheNotaireType');
        $pubs = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        return $this->render('ImmoNotaireBundle:Notaire:fiche.html.twig', array(
                    'notaire' => $notaire, 'user' => $user, 'form' => $form->createView(), 'pubs' => $pubs
        ));
    }

    /**
     * Lists all user entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('ImmoNotaireBundle:User')->findAll();
        $pubs = $em->getRepository('PubliciteBundle:Publicite')->findAll();
        return $this->render('user/index.html.twig', array(
                    'users' => $users, 'pubs' => $pubs
        ));
    }

    /**
     * Creates a new user entity.
     *
     */
    public function newAction(Request $request) {
        $user = new User();
        $form = $this->createForm('ImmoNotaire\ImmoNotaireBundle\Form\UserType', $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            return $this->redirectToRoute('user_show', array('id' => $user->getId()));
        }

        return $this->render('user/new.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a user entity.
     *
     */
    public function showAction(User $user) {
        $deleteForm = $this->createDeleteForm($user);

        return $this->render('user/show.html.twig', array(
                    'user' => $user,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     */
    public function editAction(Request $request, User $user) {
        $deleteForm = $this->createDeleteForm($user);
        $editForm = $this->createForm('ImmoNotaire\ImmoNotaireBundle\Form\UserType', $user);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', array('id' => $user->getId()));
        }

        return $this->render('user/edit.html.twig', array(
                    'user' => $user,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a user entity.
     *
     */
    public function deleteAction(Request $request, User $user) {
        $form = $this->createDeleteForm($user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush($user);
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * Creates a form to delete a user entity.
     *
     * @param User $user The user entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(User $user) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('user_delete', array('id' => $user->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
