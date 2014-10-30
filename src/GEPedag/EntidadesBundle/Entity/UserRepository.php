<?php
namespace GEPedag\EntidadesBundle\Entity;

use Doctrine\ORM\EntityRepository;
use GEPedag\EntidadesBundle\Entity\User;

class UserRepository extends EntityRepository {

    function actualizar(User &$usuario, $encoderFactory) {
        $usuario->setLastLogin(new \DateTime('today'));
        
        $encoder = $encoderFactory->getEncoder($usuario);
        //$usuario->setSalt(md5(time()));
        $passwordCodificado = $encoder->encodePassword($usuario->getPassword(), $usuario->getSalt());
        $usuario->setPassword($passwordCodificado);
    }
} 