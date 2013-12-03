<?php

namespace Family\UserBundle\Form\Type;

//use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('address_one', 'text', array(
                'required'      => true,
            ))
            ->add('address_two', 'text', array(
                'required'      => false,
            ))
            ->add('zip_code', 'text')
            ->add('city', 'text')
            ->add('country_code', 'entity', array(
                'class'     => 'FamilyUserBundle:CountryCode',
                'property'  => 'country_description',
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => false,
            'data_class' => 'Family\UserBundle\Entity\Address',
        ));
    }

    public function getName()
    {
        return 'family_user_address';
    }
}