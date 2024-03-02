<?php

namespace App\Form;

use App\Entity\Individu;
use App\Entity\Evaluation;
use App\Entity\LigneEvaluation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneEvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('note')
            ->add('appreciation')
            ->add('evaluation', EntityType::class, [
                'class' => Evaluation::class,
                'choice_label' => 'numero',
                'label' => 'EVALUATION'
            ])
            ->add('individu', EntityType::class, [
                'class' => Individu::class,
                'choice_label' => 'nom',
                'label' => 'ELEVE',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->join('i.typeindividu', 't')
                        ->where('t.libelle = :libelle')
                        ->setParameter('libelle', 'eleve');
                },
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => LigneEvaluation::class,
        ]);
    }
}
