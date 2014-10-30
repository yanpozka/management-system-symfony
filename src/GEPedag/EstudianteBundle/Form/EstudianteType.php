<?php

namespace GEPedag\EstudianteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstudianteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ci')
            ->add('primerApellido')
            ->add('nombres')
            ->add('segundoApellido')
            ->add('anioEstudio')
            ->add('fechaIngrEducSup', 'date', ['widget' => "single_text"])
            ->add('fechaIngrIsp', 'date', ['widget' => "single_text"])
            ->add('fechaIngrEsp', 'date', ['widget' => "single_text"])
            ->add('colorPiel', 'choice', [
                'choices' => [
                    "blanco" => "Blanca",
                    "mestizo" => "Mestizo",
                    "negro" => "Negro"],
                /*'expanded' => TRUE,
                'preferred_choices' => ['mestizo']*/])
            ->add('direccion', 'textarea')
            ->add('telefono')
            ->add('orgPolitica', 'choice', [
                'choices' => [
                    "Ninguna" => "Ninguna",
                    "UJC" => "UJC",
                    "PCC" => "PCC"
                ]])
            ->add('sede')
                
            // Listas:
            ->add('fuenteIngreso')
            ->add('procedenciaMadre')
            ->add('municipio')
            ->add('provincia')
            ->add('procedenciaEscolar')
            ->add('claseEstudiante')
            ->add('codigoBaja')
            ->add('procedenciaPapa')
            ->add('tipoPlan')
            ->add('especialidad')
            ->add('asignatura' /*, 'que-poner', array('label' => "Asignaturas")*/);
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GEPedag\EntidadesBundle\Entity\Estudiante'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gepedag_estudiantebundle_estudiante';
    }
}
