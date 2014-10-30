<?php

namespace GEPedag\EntidadesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EspecialidadType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('asignatura')
            ->add('submit', 'submit', array('label' => 'Enviar'));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GEPedag\EntidadesBundle\Entity\Especialidad'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gepedag_entidadesbundle_especialidad';
    }
}
