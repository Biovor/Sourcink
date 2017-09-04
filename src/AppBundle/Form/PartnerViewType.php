<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PartnerViewType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('s',ChoiceType::class, array(
                    'choices'  => array(
                        '12 logos par ligne' => 1,
                        '6 logos par ligne ' => 2,
                        '4 logos par ligne' => 3,
                        '3 logos par ligne' => 4,
                        '2 logos par ligne' => 6,
                        '1 logos par ligne' => 12,
                    ),
                    'multiple' => false,
                    'expanded' => true,
                )
            )

            ->add('m',ChoiceType::class, array(
                    'choices'  => array(
                        '12 logos par ligne' => 1,
                        '6 logos par ligne ' => 2,
                        '4 logos par ligne' => 3,
                        '3 logos par ligne' => 4,
                        '2 logos par ligne' => 6,
                        '1 logos par ligne' => 12,
                    ),
                    'multiple' => false,
                    'expanded' => true,
                )
            )

            ->add('l' ,ChoiceType::class, array(
                    'choices'  => array(
                        '12 logos par ligne' => 1,
                        '6 logos par ligne ' => 2,
                        '4 logos par ligne' => 3,
                        '3 logos par ligne' => 4,
                        '2 logos par ligne' => 6,
                        '1 logos par ligne' => 12,
                    ),
                    'multiple' => false,
                    'expanded' => true,
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
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\PartnerView'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_partnerview';
    }


}
