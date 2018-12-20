<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\FormBuilder;
use App\Entity\Participant;
use App\Entity\Sondage;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SondageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('formulaire',EntityType::class, array(
        'class' => FormBuilder::class,
        'choice_label' => 'name',))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sondage::class,
        ]);
    }
}
