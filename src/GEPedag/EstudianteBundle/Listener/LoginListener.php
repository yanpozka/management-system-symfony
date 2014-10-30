<?php

namespace GEPedag\EstudianteBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpKernel\Log\LoggerInterface;
use Doctrine\ORM\EntityManager;

class LoginListener
{
    private $router;
    private $usuario = null;
    private $logger = null;
    private $em = null;

    public function __construct(Router $router, LoggerInterface $logger, EntityManager $em)
    {
        $this->router = $router;
        $this->logger = $logger;
        $this->em = $em;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $this->usuario = $event->getAuthenticationToken()->getUser();
        $this->usuario->setLastLogin(new \DateTime());
        $this->em->persist($this->usuario);
        $this->em->flush();

        $d = new \DateTime('now');;
        $da = date("Y/m/d H:m:s", $d->getTimestamp());
        $this->logger->info("Se ejecutó el onSecurityInteractiveLogin para dar LastLogin=" . $da);
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (null != $this->usuario) {
            //$this->usuario->setIplastvisit($event->getRequest()->getClientIp());
            $inicio = $this->router->generate('ge_estudiante_homepage');
            $event->setResponse(new RedirectResponse($inicio));
        }
    }
}