<?php

namespace GEPedag\EstudianteBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Log\LoggerInterface;

//use Doctrine\ORM\EntityManager;

class ExceptionListener {

    private $router;
    private $session;
    private $exp = null;
    private $logger = null;

    //private $em = null;   //por si quieres guardar las exceptions

    public function __construct(Router $router, LoggerInterface $logger, Session $session/* , EntityManager $em */) {
        $this->router = $router;
        $this->logger = $logger;
        $this->session = $session;
        //$this->em = $em;
    }

    public function onKernelException(GetResponseForExceptionEvent $event) {
        $this->exp = $event->getException();
        $this->logger->critical("[-] CAPTURADA: " . $this->exp->getMessage()
                . " Código: " . $this->exp->getCode()
                . " Línea: " . $this->exp->getLine()
                . " Archivo: " . $this->exp->getFile());
        
        $this->session->getFlashBag()->add('error', $this->exp->getMessage());
        $inicio = $this->router->generate('ge_estudiante_homepage');
        $event->setResponse(new RedirectResponse($inicio));
        $event->stopPropagation();
    }

    public function onKernelResponse(FilterResponseEvent $event) {
//        if (null == $this->exp)
//            return;
//        $this->session->getFlashBag()->add('error', $this->exp->getMessage());
//        $inicio = $this->router->generate('ge_estudiante_homepage');
//        $event->setResponse(new RedirectResponse($inicio));
    }

}