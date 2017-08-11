<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SourcinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add(
                'title', TextareaType::class,
                array(
                    'label' => 'Titre',
                    'attr' =>
                        array(
                            'class' => 'materialize ckeditor'
                        )
                )
            )
            ->add(
                'text1', TextareaType::class,
                array(
                    'label' => '1er paragraphe',
                    'required' => false,
                    'attr' =>
                        array(
                            'class' => 'materialize ckeditor'
                        )
                )
            )
            ->add(
                'text2', TextareaType::class,
                array(
                    'label' => '2éme paragraphe',
                    'required' => false,
                    'attr' =>
                        array(
                            'class' => 'materialize ckeditor'
                        )
                )
            )

            ->add(
                'submit', SubmitType::class,
                array(
                    'label' => 'Enregistrer',
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
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sourcink'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sourcink';
    }


}
