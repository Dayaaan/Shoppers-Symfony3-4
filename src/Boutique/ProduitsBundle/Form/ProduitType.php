<?php

namespace Boutique\ProduitsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Boutique\ProduitsBundle\Entity\Image;
use Boutique\ProduitsBundle\Form\ImageType;
use Boutique\ProduitsBundle\Form\CategoryType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Boutique\ProduitsBundle\Form\ImagePrincipaleType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;


class ProduitType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
                ->add('description', TextareaType::class)
                ->add('price', MoneyType::class)
                ->add('quantity', IntegerType::class)
                ->add('categories')
                ->add('imagePrincipale', ImagePrincipaleType::class)
                ->add('images', CollectionType::class,
                    [
                        'entry_type' => ImageType::class,
                        'entry_options' => array('label' => false),
                        'allow_add' => true
                    ])
                ->add("Submit", SubmitType::class)
                ;
    }
    /**
     * {@inheritdoc}
     */
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Boutique\ProduitsBundle\Entity\Produit'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'boutique_produitsbundle_produit';
    }


}
