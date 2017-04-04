<?php

namespace ImmoNotaire\ImmoNotaireBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add('etude', TextType::class, array('label' => 'Etude de maître','required'=>false))
                ->add('siege', TextType::class, array('label' => 'Siège','required'=>false))
                ->add('personneAContacter', TextType::class, array('label' => 'Personne à contacter','required'=>false))
                ->add('contact', TextType::class, array('label' => 'portable','required'=>false))
                ->add('telephone', TextType::class, array('label'=>'telephone','required'=>false))
                ->add('telecopie', TextType::class, array('label'=>'télécopie','required'=>false));
              
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix() {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName() {
        return $this->getBlockPrefix();
    }

}
