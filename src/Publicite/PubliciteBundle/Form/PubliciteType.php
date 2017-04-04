<?php

namespace Publicite\PubliciteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PubliciteType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, array())
                ->add('content', \Symfony\Component\Form\Extension\Core\Type\TextareaType::class, array('required' => false, 'attr' => array('style' => 'width:500px; height:200px')));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Publicite\PubliciteBundle\Entity\Publicite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'publicite_publicitebundle_publicite';
    }

}
