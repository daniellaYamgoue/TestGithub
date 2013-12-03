<?php

namespace Family\UserBundle\Form\Type;

//use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminOrderFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product', 'entity', array(
                'class'     => 'FamilyUserBundle:Product',
                'property'  => 'productName',
            ))
            ->add('person', 'entity', array(
                'class'     => 'FamilyUserBundle:Person',
                'property'  => 'FullName',
                'label'     => 'Author'
            ))
            ->add('partner', 'entity', array(
                'class'     => 'FamilyUserBundle:Person',
                'property'  => 'FullName',
                'label'     => 'Partner'
            ))
            ->add('order_status', 'entity', array(
                'class'     => 'FamilyUserBundle:OrderStatus',
                'property'  => 'orderStatus',
            ))
            ->add('create_date', 'datetime', array(
                'required'  => false,
            ))
            ->add('purchase_date', 'datetime', array(
                'required'  => false,
            ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => false,
            'data_class' => 'Family\UserBundle\Entity\Order',
        ));
    }

    public function getName()
    {
        return 'family_user_admin_order';
    }
}