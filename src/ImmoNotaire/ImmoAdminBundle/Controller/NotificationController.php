<?php

namespace ImmoNotaire\ImmoAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Notification\NotificationBundle\Entity\Notification;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class NotificationController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository('NotificationBundle:Notification')->findBy(array('vu'=>0));
        $alert =$em->getRepository('NotificationBundle:Notification')->findAll();
        foreach ($notification as $notif) {
            $notif->setVu(1);
            $em->persist($notif);
        }
        $em->flush();
        $note=$em->getRepository('NotificationBundle:Notification')->findBy(array('vu'=>0));
        $utilisateur = $em->getRepository("ImmoNotaireBundle:User")->findAll();
        return $this->render('ImmoAdminBundle:Default:Notification.html.twig', array('user' => $user,
                    'notif' => $note, 'utilisateurs' => $utilisateur, 'notifTab'=>$alert,'val'=>'notification'
        ));
    }

    public function deleteAction(Request $request) {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("ImmoAnnonceBundle:Notification")->find($id);
        $em->remove($notification);
        $em->flush();

        return $this->redirectToRoute("list-notification");
    }

    public function deleteAllAction() {
        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("NotificationBundle:Notification")->findAll();
        foreach ($notification as $notif) {
            $em->remove($notif);
        }
        $em->flush();

        $session = new Session();
        $session->getFlashBag()->add('info', "Toutes les notificatiois ont été supprimé.");

        return $this->redirectToRoute("immo_admin_homepage");
    }

    // section ajax pour la partie notification

    public function newAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $notification = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        
        $response = new JsonResponse();
        return $response->setData(array('nombre' => count($notification)));
    }

}
