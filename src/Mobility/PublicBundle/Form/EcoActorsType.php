<?php

namespace Mobility\PublicBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EcoActorsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', 'text')
            ->add('title', 'text')
            ->add('type', 'choice', array(
            	'choices' => array(
            		'0' => 'à pied'
            		),
            	'required'    => true,
    			'empty_value' => 'Choisissez un type de transport',
    			'empty_data'  => null
            	))
            ->add('start', 'text')
            ->add('arrival', 'text')
            ->add('description', 'textarea')
            ->add('game', 'checkbox')
            ->add('ges', 'hidden', array(
            	'data' => 0
            	))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mobility\PublicBundle\Entity\EcoActors'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mobility_publicbundle_ecoactors';
    }
}
