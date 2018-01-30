<?php

namespace UE235\BibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AuteurType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text')
            ->add('prenom', 'text')
            ->add('dateNaissance', 'birthday')
            ->add('sexe', 'choice', array('choices' => array('F'=>'Féminin','M'=>'Masculin')));
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UE235\BibliothequeBundle\Entity\Auteur'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ue235_bibliothequebundle_auteur';
    }
}
