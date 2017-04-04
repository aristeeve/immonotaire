<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace ImmoNotaire\ImmoNotaireBundle\Form;

use FOS\UserBundle\Util\LegacyFormHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ProfileType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->buildUserForm($builder, $options);

        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'form.current_password',
            'label_attr' => array('class'=> 'control-label'),
            'attr'=> array('class' => 'form-control'),
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword(!empty($options['validation_groups']) ? array('groups' => array(reset($options['validation_groups']))) : null),
        ));
    }

    // BC for SF < 3.0
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    protected function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etude', TextType::class, array('label' => 'Etude de maître', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('siege', TextType::class, array('label' => 'Siège','required'=>false, 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('personneAContacter', TextType::class, array('label' => 'Personne à contacter', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('contact', TextType::class, array('label' => 'portable', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('telephone', TextType::class, array('label'=>'telephone','required'=>false, 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('telecopie', TextType::class, array('label'=>'télécopie','required'=>false, 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('email', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\EmailType'), array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'style'=>'margin-bottom:15px;')))
                ->add('name', TextType::class, array('label' => 'Nom', 'label_attr' => array('class' => 'control-label'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px;')))
                ->add('firstname', TextType::class, array('label' => 'Prenom', 'label_attr' => array('class' => 'control-label'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px;')))
                ->add('ville', TextType::class, array('label' => 'Ville', 'label_attr' => array('class' => 'control-label'), 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px;')))
        ;
    }
}
