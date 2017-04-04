<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;



class AnnonceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('titre', TextType::class, array('required' => true))
                ->add('description', TextareaType::class, array('required' => false))//pas requis
                ->add('ville', TextType::class, array('required' => true,'attr' => array('class' => 'villes')))
                ->add('commune', TextType::class, array('required' => false))//pas requis
                ->add('telMobile', TextType::class, array('required' => false))
                ->add('telFixe', TextType::class, array('required' => false))
                ->add('prix', TextType::class, array('required' => true))
                ->add('disponibilite', TextType::class, array('required' => false))
                ->add('media', MediaType::class, array('required' => false))// pas requis
                // ->add('modifieLe')
                ->add('active', CheckboxType::class)
                ->add('affiche_contact', CheckboxType::class)
                // ->add('creeLe')
                //->add('user')
                ->add('type_annonce', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_annonce', 'choice_label' => 'nom',
                    'choice_value' => 'nom'));
        //->add('type_biens', EntityType::class, array('class'=>'ImmoAnnonceBundle:Type_biens','choice_label'=>'nom',
        //  'choice_value'=>'nom'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'immonotaire_immoannoncebundle_annonce';
    }

}
