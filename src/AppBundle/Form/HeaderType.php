<?php

namespace AppBundle\Form;

use AppBundle\Entity\Slider;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HeaderType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title', TextareaType::class,
                array(
                    'label' => 'Titre',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le titre',
                            'class' => 'ckeditor',
                        )
                )
            )
            ->add(
                'text', TextareaType::class,
                array(
                    'label' => 'Sous-titre',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le sous-titre',
                            'class' => 'ckeditor',
                        )
                )
            )
            ->add('picture', PictureType::class)
            ->add(
                'url', TextType::class,
                array(
                    'label' => 'Lien',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le lien vers la page voulu',
                        )
                )
            )
            ->add(
                'nameUrl', TextType::class,
                array(
                    'label' => 'Nom du lien',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le nom du lien',
                        )
                )
            )
            ->add(
                'submit', SubmitType::class,
                array(
                    'label'=>'Enregistrer',
                    'attr' =>
                        array(
                            'class' => 'btn blue'
                        )
                )
            );
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {

    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_header';
    }


}
