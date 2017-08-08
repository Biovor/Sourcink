<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('path', TextType::class,
                array(
                    'label' => 'Lien',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le lien du site partenaire',
                        )
                )
            )
            ->add('picture', PictureType::class)
            ->add('partnerName', TextType::class,
                array(
                    'label' => 'Nom',
                    'attr' =>
                        array(
                            'placeholder' => 'Entrez le nom de la personne',
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
            'data_class' => 'AppBundle\Entity\Partner'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_partner';
    }


}
