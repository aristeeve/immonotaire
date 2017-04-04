<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImmoNotaire\ImmoNotaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;
use Notification\NotificationBundle\Entity\Notification;

class SecurityController extends Controller {

    /**
     * @param Request $request
     *
     * @return Response
     */
    public function loginAction(Request $request) {
        /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();
        $pubs = $em->getRepository("PubliciteBundle:Publicite")->findAll();
        $authErrorKey = Security::AUTHENTICATION_ERROR;
        $lastUsernameKey = Security::LAST_USERNAME;

        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }

        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

        $csrfToken = $this->has('security.csrf.token_manager') ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue() : null;

//         $notif = new Notification();
//
//            $notif->setType("profile");
//            $notif->setAction("connexion");
//            $notif->setUser($user);
//            $em->persist($notif);
//            $em->flush();

        return $this->renderLogin(array(
                    'last_username' => $lastUsername,
                    'error' => $error,
                    'csrf_token' => $csrfToken,
                    'pubs' => $pubs
        ));
    }

    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return Response
     */
    protected function renderLogin(array $data) {
        return $this->render('@FOSUser/Security/login.html.twig', $data);
    }

    public function checkAction() {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    public function logoutAction() {
        $user = $this->getUser();
        $notif = new Notification();
        $em = $this->getDoctrine()->getManager();
        $notif->setType("utilisateur");
        $notif->setAction("deconnexion");
        $notif->setUser($user);
        $em->persist($notif);
        $em->flush();
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

}
