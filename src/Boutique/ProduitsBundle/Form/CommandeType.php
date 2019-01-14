<?php

namespace Boutique\ProduitsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class CommandeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class,
                    [ 
                        'constrainst' => new Length(['min' => 3,'max' => 10]),
                        'invalid_message' => "Nombre de caractères : entre 3 et 10 caractères",
                        new NotBlank()
                    ])
                ->add('firstname', TextType::class,
                    [ 
                        'constrainst' => new Length(['min' => 3,'max' => 10]),
                        'invalid_message' => "Nombre de caractères : entre 3 et 10 caractères",
                        new NotBlank()
                    ])
                ->add('adress', TextType::class,
                    [ 
                        'constrainst' => new Length(['min' => 3,'max' => 100]),
                        'invalid_message' => "Nombre de caractères : entre 3 et 100 caractères",
                        new NotBlank()
                    ])
                ->add('city', TextType::class,
                    [ 
                        'constrainst' => new Length(['min' => 3,'max' => 10]),
                        'invalid_message' => "Nombre de caractères : entre 3 et 10 caractères",
                        new NotBlank()
                    ])
                ->add('zipcode', TextType::class,
                    [ 
                        'constrainst' => new Length(['min' => 3,'max' => 10]),
                        'invalid_message' => "Nombre de caractères : entre 3 et 10 caractères",
                        new NotBlank()
                    ])
                ->add('createdAt', DateTimeType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\ProduitsBundle\Entity\Commande'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boutique_produitsbundle_commande';
    }


}
