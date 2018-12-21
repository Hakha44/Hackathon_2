<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Participant;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entrepriseName')
            ->add('name')
            ->add('firstname')
            ->add('email')
            ->add('phoneNumber')
            ->add('quality', HiddenType::class, ['empty_data' => 0, 'data' => 0])
            ->add('present', HiddenType::class, ['empty_data' => 0, 'data' => 0])
            ->add('function')
            ->add('event', EntityType::class, [
                'class' => Event::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
