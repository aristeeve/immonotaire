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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class RechercheType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('ville', TextType::class, array('required' => false, 'attr' => array('name' => 'ville', 'class' => 'villes')))
                ->add('type_biens', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_biens', 'choice_label' => 'nom', 'required' => false,
                    'choice_value' => 'nom', 'attr' => array('class' => 'TypeBien')))
                ->add('statut', ChoiceType::class, array('required' => false, 'choices' => array('A louer' => 'Location', 'A vendre' => 'Vente'),
                    'expanded' => true,
                    'multiple' => false, 'preferred_choices' => 'Location'))
                ->add('modeleAppart', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_appart',
                    'label' => 'Modèle appartement',
                    'placeholder' => 'Selectionner l\'appartement',
                    'required' => false,
                    'choice_label' => 'nom',
                    'choice_value' => 'nom',
                    'attr' => array('id' => 'appart')))
                ->add('modeleTerrain', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_terrain',
                    'label' => 'Modèle terrain',
                    'placeholder' => 'Selectionner le terrain',
                    'required' => false,
                    'choice_label' => 'nom',
                    'choice_value' => 'nom',
                    'attr' => array('id' => 'terrain')))
                ->add('modeleMaison', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_maison',
                    'label' => 'Modèle maison',
                    'placeholder' => 'Selectionner la maison',
                    'required' => false,
                    'choice_label' => 'nom',
                    'choice_value' => 'nom',
                    'attr' => array('id' => 'maison')))
                ->add('modeleLocal', EntityType::class, array('class' => 'ImmoAnnonceBundle:Type_local',
                    'label' => 'Modèle local',
                    'placeholder' => 'Selectionner le local',
                    'required' => false,
                    'choice_label' => 'nom',
                    'choice_value' => 'nom',
                    'attr' => array('id' => 'local')))
                ->add('piece', IntegerType::class, array('required' => false, 
                    'label' => 'Pièce', 
                    'attr' => array('name' => 'piece', 'class' => 'piece')))
                ->add('superficie', IntegerType::class, array('required' => false, 
                    'label' => 'Superficie', 
                    'attr' => array('name' => 'superficie', 'class' => 'superficie')))
                 ->add('prix', IntegerType::class, array('required' => false, 
                    'label' => 'Prix Max', 
                    'attr' => array('name' => 'prix', 'class' => 'prix')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => null
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return null;
    }

}
