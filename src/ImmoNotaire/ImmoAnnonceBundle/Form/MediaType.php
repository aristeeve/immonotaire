<?php

namespace ImmoNotaire\ImmoAnnonceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class MediaType extends AbstractType {

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('file', FileType::class, array('label' => false,'data_class' => null, 'required' => false, 'attr' => array('class' => 'file1')))
                ->add('file1', FileType::class, array('label' => false, 'data_class' => null, 'required' => false, 'attr' => array('class' => 'file2')))
                ->add('file2', FileType::class, array('label' => false, 'data_class' => null, 'required' => false, 'attr' => array('class' => 'file3')))
                ->add('file3', FileType::class, array('label' => false, 'data_class' => null, 'required' => false, 'attr' => array('class' => 'file4')))
                ->add('file4', FileType::class, array('label' => false, 'data_class' => null, 'required' => false, 'attr' => array('class' => 'file5')));


        
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'ImmoNotaire\ImmoAnnonceBundle\Entity\Media'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'immonotaire_immoannoncebundle_media';
    }

}
