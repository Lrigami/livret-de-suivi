<?php

namespace App\Form;

use App\Entity\Period;
use App\Entity\Booklet;
use App\Enum\PeriodType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PeriodFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('type', ChoiceType::class, [
                'label' => 'Type',
                'choices' => PeriodType::cases(),
                'choice_label' => fn($pt) => $pt->value,
                'choice_value' => fn($pt) => $pt?->name,
                'disabled' => true, // si tu veux juste afficher mais pas changer le type
            ])
            ->add('start_date', null, [
                'widget' => 'single_text',
            ])
            ->add('end_date', null, [
                'widget' => 'single_text',
            ])
            ->add('booklets', EntityType::class, [
                'class' => Booklet::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Period::class,
        ]);
    }
}
