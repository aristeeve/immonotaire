<?php

namespace Newsletter\NewsletterBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Newsletter\NewsletterBundle\Entity\Newsletter;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller {

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));
        $newsletters = $em->getRepository("NewsletterBundle:Newsletter")->findBy(array('enable' => 1));

        return $this->render("ImmoAdminBundle:Default:list-mail-newsletter.html.twig", array('notif' => $notif, 'val' => 'newsletter', 'newsletters' => $newsletters, 'user' => $user));
    }

    public function sendAction() {
        $em = $this->getDoctrine()->getManager();
        $annonce = $em->getRepository("ImmoAnnonceBundle:Annonce")->findBy(array('active' => 1, 'supprimer' => 0), array('id' => 'DESC'), 12);

        $newsletters = $em->getRepository("NewsletterBundle:Newsletter")->findBy(array('enable' => 1));
        foreach ($newsletters as $newsletter) {

            $message = \Swift_Message::newInstance()
                    ->setSubject('Immo-notaire.ci')
                    ->setFrom(array('wisdom@epistrophe.com' => 'Immonotaire.ci'))
                    ->setTo($newsletter->getEmail())
                    ->setBody($this->renderView('ImmoAdminBundle:Default:newsletter.html.twig', array('date' => new \Datetime,
                                'annonces' => $annonce,
                    )))
                    ->setContentType('text/html');
            $result = $this->get('mailer')->send($message);
        }

        $session = new Session();
        $session->getFlashBag()->add('letter', "Envoi de newsletter effectué");


        return $this->redirectToRoute('list_newsletter');
    }

    public function WrittingNewsletterAction(Request $request) {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm('ImmoNotaire\ImmoAdminBundle\Form\NewsletterType');
        $form->handleRequest($request);
        $notif = $em->getRepository("NotificationBundle:Notification")->findBy(array('vu' => 0));


        return $this->render("ImmoAdminBundle:Default:writtingNewsletter.html.twig", array('notif' => $notif,
                    'user' => $user,
                    'val' => 'newsletter', 'form' => $form->createView()));
    }

    public function sendWrittenNewsletterAction(Request $request) {
        $content = $request->get('content');
        $titre = $request->get('titre');
        $em = $this->getDoctrine()->getManager();
        if (!empty($content) && !empty($titre)) {
            $newsletters = $em->getRepository("NewsletterBundle:Newsletter")->findBy(array('enable' => 1));
            foreach ($newsletters as $newsletter) {

                $message = \Swift_Message::newInstance()
                        ->setSubject('Immo-notaire.ci')
                        ->setFrom(array('wisdom@epistrophe.com' => 'Immonotaire.ci'))
                        ->setTo($newsletter->getEmail())
                        ->setBody($this->renderView('ImmoAdminBundle:Default:RedactionNewsletter.html.twig', array('date' => new \Datetime,
                                    'titre' => $titre, 'content' => $content
                        )))
                        ->setContentType('text/html');
                $result = $this->get('mailer')->send($message);
            }
            $session = new Session();
            $session->getFlashBag()->add('letter', "Envoi de newsletter effectué");


            return $this->redirectToRoute('list_newsletter');
        }
       
    }

    // utilisaer dans la zone user
    public function newAction(\Symfony\Component\HttpFoundation\Request $request) {
        $new = new Newsletter();
        $em = $this->getDoctrine()->getManager();
        $new->setEmail($request->get('newsletter'));
        $em->persist($new);
        $em->flush($new);


        $session = new Session();
        $session->getFlashBag()->add('newsletter', "Vous êtes inscrit à notre newsletter, Merci");

        return $this->redirectToRoute('immo_annonce_homepage');
    }

}
