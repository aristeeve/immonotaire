<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class Annonce_maison2Type extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('superficie', IntegerType::class, array('required'=>false) )
                ->add('espace_habitable', IntegerType::class, array('required'=>false))
                ->add('piece', IntegerType::class, array('required'=>false))
                ->add('chambre', IntegerType::class, array('required'=>false))
                ->add('salon', IntegerType::class, array('required'=>false))
                ->add('salle_bain', IntegerType::class, array('required'=>false))
                ->add('etage', IntegerType::class, array('required'=>false))
                ->add('niveau_etage', IntegerType::class, array('required'=>false))
                ->add('annee', IntegerType::class, array('required'=>false))
                ->add('meuble', ChoiceType::class, array('choices'=>array('Oui'=>'1','Non'=>'1')))
                ->add('place_parking', IntegerType::class, array('required'=>false))
                ->add('interphone')
                ->add('chauffe_eau')
                ->add('balcon')
                ->add('cour')
                ->add('piscine')
                ->add('jardin')
                ->add('garage')
                ->add('parking')
                ->add('ascenseur')
                ->add('gardiennage')
                ->add('systeme_alarme')
                ->add('bordure_route')
                ->add('vue_lagune')
                ->add('vue_mer')
               // ->add('user')
                ->add('annonce', Annonce2Type::class, array('label'=>false))
                ->add('type_maison', EntityType::class, array('class'=>'ImmoAnnonceBundle:Type_maison','choice_label'=>'nom',
                   'choice_value'=>'nom'))        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ImmoNotaire\ImmoAnnonceBundle\Entity\Annonce_maison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'immonotaire_immoannoncebundle_annonce_maison';
    }


}
