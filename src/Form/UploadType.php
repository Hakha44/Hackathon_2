<?php
/**
 * Created by PhpStorm.
 * User: amelie
 * Date: 20/12/18
 * Time: 12:10
 */

namespace App\Form;


use App\Entity\Event;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Constraints;

class UploadType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'event',
                EntityType::class,
                [
                    'class' => Event::class,
                    'choice_label' => 'name',
                ]
            )
            ->add(
                'csvFile',
                Type\FileType::class,
                [
                    'label' => 'Fichier d\'import CSV',
                    'attr' => ['accept' => 'text/csv'],
                    'constraints' => [
                        new Constraints\NotBlank(),
                        new Constraints\File(['maxSize' => '1024k', 'mimeTypes' => ['text/csv', 'text/plain']])
                    ]
                ]
            )
        ;
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }

}