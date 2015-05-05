<?php

namespace PS\PlaneBundle\Form;

use PS\PlaneBundle\Form\LocationType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlaneType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'required' => true
            ))
            ->add('currentLocationX', 'integer', array(
                'required' => true
            ))
            ->add('currentLocationY', 'integer', array(
                'required' => true
            ))
            ->add('remainingFuel', 'integer', array(
                'required' => true
            ))
            ->add('passengerCount', 'integer', array(
                'required' => true
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\PlaneBundle\Entity\Plane',
            'csrf_protection' => false,
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'plane';
    }
}
