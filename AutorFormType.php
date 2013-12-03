<?php

namespace Family\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\ProfileFormType;

class AutorFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', 'text')
            ->add('middle_name', 'text', array(
                'required'      => false,
            ))
            ->add('maiden_name', 'text')
                
            ->add('birthdate', 'birthday', array(
                'years'         => range(date('Y') - 100, date('Y') - 18),
                'empty_value'   => array('year' => 'Année', 'month' => 'Mois', 'day' => 'Jour'),
                'required'      => true,
            ))
            ->add('address', new AddressFormType())
            ->add('birth_city', 'text')
            ->add('birth_country', 'entity', array(
                'class'     => 'FamilyUserBundle:CountryCode',
                'property'  => 'country_description',
            ))
            ->add('mobile_phone', 'text')
            ->addEventListener(\Symfony\Component\Form\FormEvents::PRE_SET_DATA, function(\Symfony\Component\Form\FormEvent $event) use ($builder) {
                $form = $event->getForm();
                $data = $event->getData();
                if($data === null) {
                    return;
                }
                
                if ($data->getSex()) {
                    $form->add('test_title', 'choice', array(
                        'choices'   => array(
                            '1' => 'M.',
                        ),
                        'mapped' => FALSE
                    ));
                }else {
                    $form->add('test_title', 'choice', array(
                        'choices'   => array(
                            '2' => 'Mme.',
                            '3' => 'Mlle.',
                        ),
                        'mapped' => FALSE
                    ));
                    if ($data->getMaritalStatus()->getStatus() == 'married') {
                        $form->add('last_name', 'text');
                    }
                }
            })
            ->add('mobile_phone', 'text');
            
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'inherit_data' => false,
            'data_class' => 'Family\UserBundle\Entity\Person',
        ));
    }

    public function getName()
    {
        return 'family_edit_user_person';
    }
}
