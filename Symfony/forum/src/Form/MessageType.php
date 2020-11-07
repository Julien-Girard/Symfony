<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MessageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	$listeUsers = $options['liste_users'];
    	$listeThemes = $options['liste_themes'];
    	
        $builder
        	->add('theme',ChoiceType::class, ['label' => 'Thème', 'choices'=> [$listeThemes], 'choice_value' => 'id', 'choice_label' => 'sujet'])
        	->add('texte', TextType::class, ['label' => 'Texte du message'])
        	->add('createur', ChoiceType::class, ['label' => 'Auteur', 'choices'=> [$listeUsers], 'choice_value' => 'id', 'choice_label' => 'pseudo'])
            ->add('submit', SubmitType::class, ['label' => 'OK'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        	'liste_users' => array(),
        	'liste_themes' => array(),
        ]);
    }
}
