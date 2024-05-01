<?php

// namespace App\Form;

// use App\Entity\Post;
// use Symfony\Component\Form\AbstractType;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\OptionsResolver\OptionsResolver;
// use Vich\UploaderBundle\Form\Type\VichImageType;

// class PostFormType extends AbstractType
// {
//     public function buildForm(FormBuilderInterface $builder, array $options): void
//     {
//         $builder
//             ->add('description', TextType::class, ['attr' =>
//             ['class' => 'input-type']])
//             ->add('body')
//             ->add('imageFile', VichImageType::class, [
//                 'required' => false,
//                 'allow_delete' => true,
//                 'delete_label' => 'Delete',
//                 'download_uri' => true,
//                 'download_label' => 'Upload',
//                 'image_uri' => true,
//                 'asset_helper' => true,
//             ]);
//     }

//     public function configureOptions(OptionsResolver $resolver): void
//     {
//         $resolver->setDefaults([
//             'data_class' => Post::class,
//         ]);
//     }
// }

namespace App\Form;

use App\Entity\Post;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control', // Ajoutez la classe Bootstrap form-control
                    'placeholder' => 'Description', // Facultatif : placeholder pour l'input
                ]
            ])
            ->add('body', TextType::class, [
                'attr' => [
                    'class' => 'form-control', // Ajoutez la classe Bootstrap form-control
                    'placeholder' => 'Corps du message', // Facultatif : placeholder pour l'input
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true,
                'delete_label' => 'Supprimer',
                'download_uri' => true,
                'download_label' => 'Télécharger',
                'image_uri' => true,
                'asset_helper' => true,
                'attr' => [
                    'class' => 'form-control', // Ajoutez la classe Bootstrap form-control
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
