<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RecetaType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nombre')
                ->add('dificultad', ChoiceType::class, array(
                    'choices'=>array(
                        'Facil'=>'Facil',
                        'Medio'=>'Medio',
                        'Dificil'=>'Dificil'
                        ),
                    ))
                ->add('descripcion')
                ->add('visto')
                ->add('autor')
                ->add('brochure', FileType::class, array('label'=>'Archivo a cargar'))
                ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Receta'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_receta';
    }


}
