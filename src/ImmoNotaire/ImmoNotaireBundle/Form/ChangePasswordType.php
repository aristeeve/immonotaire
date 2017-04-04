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

class ChangePasswordType extends AbstractType
{
   
 public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('current_password', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'), array(
            'label' => 'form.current_password',
            'translation_domain' => 'FOSUserBundle',
            'mapped' => false,
            'constraints' => new UserPassword(),
            'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'placeholder' => 'form.current_password', 'style'=>'margin-bottom:15px;'

            )));
        $builder->add('plainPassword', LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\RepeatedType'), array(
            'type' => LegacyFormHelper::getType('Symfony\Component\Form\Extension\Core\Type\PasswordType'),
            'options' => array('translation_domain' => 'FOSUserBundle'),
            'first_options' => array('label' => 'form.new_password', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'placeholder' => 'form.new_password', 'style'=>'margin-bottom:15px;')),
            'second_options' => array('label' => 'form.new_password_confirmation', 'label_attr' => array('class'=> 'control-label'),'attr'=> array('class' => 'form-control', 'placeholder' => 'Resaisir le mot de passe', 'style'=>'margin-bottom:15px;')),
            'invalid_message' => 'fos_user.password.mismatch',
        ));
    }


    public function getName() {
        return 'utilisateur_change_password';
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ChangePasswordFormType';
    }
}
