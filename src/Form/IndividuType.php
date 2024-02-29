<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Individu;
use App\Entity\TypeIndividu;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IndividuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroMatricule')
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('telephone')
            ->add('typeindividu', EntityType::class, [
                'class' => TypeIndividu::class,
                'choice_label' => 'libelle',
                'required' => false
            ])
            ->add('classe', EntityType::class, [
                'class' => Classe::class,
                'choice_label' => 'libelle',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Individu::class,
        ]);
    }
}
