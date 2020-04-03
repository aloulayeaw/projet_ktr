<?php

namespace App\Form;

use App\Entity\Entrepreneur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EntrepreneurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, [
                'required' => true,
                'label'  => 'Votre Nom',
            ])

            ->add('entreprise',TextType::class, [
                'required' => False,
                'label'  => 'Nom de l\'Entreprise',
            ])

            ->add('email',TextType::class, [
                'required' => False,
                'label'  => 'Votre Email',
            ])
            ->add('telephone',TextType::class, [
                'required' => False,
                'label'  => 'Votre Telephone',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Entrepreneur::class,
        ]);
    }
}
