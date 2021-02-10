<?php

namespace App\Form;

use App\Entity\Produit;
use App\Entity\CategorieProduit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProduit')
            ->add('Prix', IntegerType::class)
            ->add('Caracteristiques')
            ->add('image')
            ->add('categorieproduit',EntityType::class,[
                'class'=> CategorieProduit::class,
                'choice_label' => 'LibelleCat'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
