<?php


namespace Boutique\UserBundle\Form;

use Symfony\Component\Intl\Intl;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $countries = Intl::getRegionBundle()->getCountryNames();
        $builder->add('name')
                ->add('firstname')
                ->add('adress')
                ->add('city')
                ->add('zipcode')
                ->add('states', ChoiceType::class, [
                    'placeholder' => 'Choose a states',
                    'choices' => array_flip($countries)
                ]);
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

}