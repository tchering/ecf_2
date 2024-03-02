<?php

namespace App\Form;

use App\Entity\AnneeScolaire;
use App\Entity\College;
use App\Entity\Evaluation;
use App\Entity\Individu;
use App\Entity\Matiere;
use App\Entity\Trimestre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', EntityType::class, [
                'class' => AnneeScolaire::class,
                'mapped' => false,
                'choice_label' => 'code'
            ])
            ->add('numero')
            ->add('dateEvaluation')
            ->add('trimestre', EntityType::class, [
                'class' => Trimestre::class,
                'choice_label' => 'libelle',
            ])
            ->add('individu', EntityType::class, [
                'class' => Individu::class,
                'choice_label' => 'nom',
                'label' => 'FORMATEUR'
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'libelle',
            ])
            ->add('college', EntityType::class, [
                'class' => College::class,
                'choice_label' => 'id',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
