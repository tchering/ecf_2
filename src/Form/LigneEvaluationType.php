<?php

namespace App\Form;

use App\Entity\Evaluation;
use App\Entity\Individu;
use App\Entity\LigneEvaluation;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('individu', EntityType::class, [
                'class' => Individu::class,
                'choice_label' => function (Individu $individu) {
                    return $individu->getNom() . ' ' . $individu->getPrenom();
                },
            ])
            ->add('note')
            ->add('appreciation')
            ->add('evaluation', EntityType::class, [
                'class' => Evaluation::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneEvaluation::class,
        ]);
    }
}
