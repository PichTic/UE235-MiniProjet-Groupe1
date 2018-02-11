<?php

namespace UE235\BibliothequeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LivreType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', 'text')
            ->add('description', 'textarea')
            ->add('categorie', 'entity', [
                'class'    => 'UE235\BibliothequeBundle\Entity\Categorie',
                'property' => 'nom',
                'multiple' => false,
                'required' => false,
            ])
            ->add('auteurs', 'entity', [
                'class'    => 'UE235\BibliothequeBundle\Entity\Auteur',
                'property' => 'nom',
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ])
            ->add('url', 'file')
            //->add('url', 'url')
            ->add('alt', 'text');
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'UE235\BibliothequeBundle\Entity\Livre',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ue235_bibliothequebundle_livre';
    }
}
