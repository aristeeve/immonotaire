<?php

namespace ImmoNotaire\ImmoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use ImmoNotaire\ImmoNotaireBundle\Entity\User;
use Notification\NotificationBundle\Entity\Notification;

class UtilisateurController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('ImmoNotaireBundle:User')->findAll();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));

        return $this->render('ImmoAdminBundle:Utilisateur:index.html.twig', array('user' => $user,
                    'utilisateurs' => $users, 'notif' => $notif,'val'=>'utilisateur'));
    }

    public function newAction(Request $request) {
        $user = new User();
        $currentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('ImmoNotaire\ImmoAdminBundle\Form\RegistrationType', $user);
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            $session = new Session();
            $session->getFlashBag()->add('info', "L'utilisateur a bien été crée");

            return $this->redirectToRoute('immo_admin_utilisateur');
        }
        return $this->render('ImmoAdminBundle:Utilisateur:new.html.twig', array(
                    'user' => $currentUser,
                    'form' => $form->createView(), 'notif' => $notif,'val'=>'utilisateur'
        ));
    }

    public function editAction(Request $request, User $user) {
         $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('ImmoNotaire\ImmoAdminBundle\Form\ProfileType', $user);
        $form->handleRequest($request);
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            $session = new Session();
            $session->getFlashBag()->add('info', "L'utilisateur a bien été modifié");

            return $this->redirectToRoute('immo_admin_utilisateur');
        }
        return $this->render('ImmoAdminBundle:Utilisateur:edit.html.twig', array(
                    'user' => $user,
                    'form' => $form->createView(), 'notif' => $notif,'val'=>'utilisateur'
        ));
    }

    public function ViewUserAction($utilisateur) {

        $em = $this->getDoctrine()->getManager();
        $Utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($utilisateur);
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        return $this->render('ImmoAdminBundle:Utilisateur:view.html.twig', array('utilisateur' => $utilisateur
                , 'notif' => $notif, 'user'=>$Utilisateur,'val'=>'utilisateur'));
    }

    public function RemoveUserAction($utilisateur) {

        $em = $this->getDoctrine()->getManager();
        $Utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($utilisateur);

        $em->remove($Utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'utilisateur a bien été supprimé");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }

    public function AddRoleAdminAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->addRole('ROLE_ADMIN');
        $utilisateur->setAdmin(1);
        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "Le role administrateur a bien été attribué à l'utilisateur. ");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }
    

    public function RemoveRoleAdminAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->removeRole('ROLE_ADMIN');
        $utilisateur->setAdmin(0);
        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "Le role administrateur a bien été retiré à l'utilisateur. ");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }
     public function AddPremiumAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->setPremium(1);
        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'offre premium a été attribué ");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }
     public function RemovePremiumAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->setPremium(0);
        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'offre premium a été retiré ");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }

    public function activateAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->setEnabled(1);
        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'utilisateur a bien été activé. ");

        return $this->redirectToRoute('immo_admin_utilisateur');
    }

    public function desactivateAction($id) {

        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->find($id);
        $utilisateur->setEnabled(0);

        $em->persist($utilisateur);
        $em->flush();
        $session = new Session();
        $session->getFlashBag()->add('info', "L'utilisateur a bien été désactivé.");
        return $this->redirectToRoute('immo_admin_utilisateur');
    }

}
