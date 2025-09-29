<?php

namespace App\Form;

use App\Entity\Period;
use App\Entity\Booklet;
use App\Entity\BookletPeriod;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PreSetDataEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookletPeriodFormType extends AbstractType
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (PreSetDataEvent $event) {
            /** @var BookletPeriod|null $period */
            $period = $event->getData();
            $form = $event->getForm();
            $currentUser = $this->security->getUser();

            $isEditable = false;

            if ($period !== null && $period->getBooklet() !== null) {
                $formation = $period->getBooklet()->getFormation();
                if ($formation !== null && $formation->getTeacher() !== null) {
                    $isEditable = $formation->getTeacher()->getId() === $currentUser->getId();
                }
            }

            $form->add('content', TextareaType::class, [
                'label' => 'Contenu',
                'required' => false,
                'attr' => [
                    'class' => $isEditable ? 'ckeditor readonly-false' : 'ckeditor',
                ],
            ]);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BookletPeriod::class,
        ]);
    }
}
