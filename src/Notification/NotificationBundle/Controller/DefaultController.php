<?php

namespace Notification\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NotificationBundle:Default:index.html.twig');
    }
}
