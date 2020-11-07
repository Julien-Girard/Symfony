<?php

namespace App\Form;

use App\Entity\Theme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ThemeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$listeUsers = $options['liste_users'];
    	
        $builder
        	->add('subject', TextType::class, ['label' => 'Thème'])
        	->add('author',ChoiceType::class, ['label' => 'Auteur', 'choices'=> [$listeUsers], 'choice_value' => 'id', 'choice_label' => 'pseudo'])
            ->add('submit', SubmitType::class, ['label' => 'OK'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Theme::class,
			'liste_users' => array(),
        ]);
    }
}
