<?php

namespace App\Form;

use App\Entity\College;
use App\Entity\Matiere;
use App\Entity\Individu;
use App\Entity\Trimestre;
use App\Entity\Evaluation;
use App\Entity\AnneeScolaire;
use App\Entity\Classe;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code', EntityType::class, [
                'class' => AnneeScolaire::class,
                'mapped' => false,
                'choice_label' => 'code',
                'label'=>'Annee Scolaire'
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
                'label' => 'Formateur',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->join('i.typeindividu', 't')
                        ->where('t.libelle = :libelle')
                        ->setParameter('libelle', 'formateur');
                },
            ])
            ->add('libelle',EntityType::class,[
                'class'=>Classe::class,
                'mapped'=>false,
                'label'=>'Classe',
                'choice_label'=>'libelle'
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'libelle',
            ])
            ->add('college', EntityType::class, [
                'class' => College::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
