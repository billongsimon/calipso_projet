<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Page;
use App\Entity\Fichier;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class PageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('createdAt', DateTimeType::class)
            ->add('jourAt', DateTimeType::class)
            ->add('contenu', CKEditorType::class)
            ->add('categorie', EntityType::class, ['class' => Categorie::class])
            ->add('fichier', FileType::class, [
//                'mapped'   => false, //@todo A enlever, je l'ai mis pour qu'il ne le prenne pas en compte lors de l'insertion en BDD
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Page::class,
        ]);
    }
}
