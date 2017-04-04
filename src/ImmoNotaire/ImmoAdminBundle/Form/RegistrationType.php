<?php

namespace ImmoNotaire\ImmoAdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class RegistrationType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('etude', TextType::class, array('label' => 'Etude de maître','required' => false))
                ->add('siege', TextType::class, array('label' => 'Siège', 'required' => false))
                ->add('personneAContacter', TextType::class, array('required' => false,'label' => 'Personne à contacter'))
                ->add('contact', TextType::class, array('label' => 'Portable','required' => false))
                ->add('telephone', TextType::class, array('label' => 'Telephone', 'required' => false))
                ->add('telecopie', TextType::class, array('label' => 'Télécopie', 'required' => false))
                ->add('name', TextType::class, array('label' => 'Nom'))
                ->add('firstname', TextType::class, array('label' => 'Prenom'))
                ->add('ville', TextType::class, array('label' => 'Ville'));
              //  ->add('premium',CheckboxType::class, array('label' => 'Premium'));
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
