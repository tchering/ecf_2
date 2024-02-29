<?php

namespace App\Form;

use App\Entity\AnneeScolaire;
use App\Entity\Trimestre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrimestreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('code')
            ->add('libelle')
            ->add('dateDebut')
            ->add('dateFin')
            ->add('anneescolaire', EntityType::class, [
                'class' => AnneeScolaire::class,
'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Trimestre::class,
        ]);
    }
}
