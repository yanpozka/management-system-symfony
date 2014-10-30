<?php

namespace GEPedag\EstudianteBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLogoutEvent;
// use GEPedag\EntidadesBundle\Entity\User;
use Doctrine\ORM\EntityManager;

class LogoutListener {

    private $usuario = null;
    private $em = null;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function onSecurityInteractiveLogout(InteractiveLogoutEvent $event) {
        $this->usuario = $event->getAuthenticationToken()->getUser();
        $this->usuario->setLastLogout(new \DateTime());
        $this->em->persist($this->usuario);
        $this->em->flush();
    }

//    public function onKernelResponse(FilterResponseEvent $event) {
//
//        if (null != $this->usuario) {
//            //$this->usuario->setIplastvisit($event->getRequest()->getClientIp());
//            $inicio = $this->router->generate('ge_estudiante_homepage');
//            $event->setResponse(new RedirectResponse($inicio));
//        }
//    }
}