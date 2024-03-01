<?php

namespace App\Form;

use App\Entity\AnneeScolaire;
use App\Entity\Classe;
use App\Entity\College;
use App\Entity\Matiere;
use App\Entity\Individu;
use App\Entity\Trimestre;
use App\Entity\Evaluation;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class EvaluationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero')
            ->add('dateEvaluation', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
                'label_attr' => ['class' => ''],
                'attr' => ['class' => '']
            ])
         
            ->add('code', EntityType::class, [
                'class' => AnneeScolaire::class,
                'choice_label' => 'code',
                'mapped' => false,
                'label' => 'Anneé Scolaire'
            ])
            ->add('trimestre', EntityType::class, [
                'class' => Trimestre::class,
                'choice_label' => 'code',
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
                'choice_label'=>'libelle',
                'mapped'=>false,
                'label'=>'Classe:'
            ])
            ->add('matiere', EntityType::class, [
                'class' => Matiere::class,
                'choice_label' => 'libelle',
            ])
            ->add('college', EntityType::class, [
                'class' => College::class,
                'choice_label' => 'nom',
                'label' => 'Your Label Here', // Add your label here
                'attr' => ['class' => 'd-none'],
                'label_attr' => ['class' => 'd-none'],
            ]);
          
        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $data = $event->getData();
            $data['dateEvaluation'] = (new \DateTime())->format('Y-m-d');
            $event->setData($data);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evaluation::class,
        ]);
    }
}
