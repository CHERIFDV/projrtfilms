<?php

namespace App\Form;

use App\Entity\Pay;
use App\Entity\Ouevre;
use App\Entity\Episode;
use App\Entity\Categorie;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Titre')
            ->add('Duree')
            ->add('Resume')
            ->add('Realise')
            ->add('url',FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => true
            ])
            ->add('Nb_view')
            ->add('langue')
            ->add('Numero_episode')
            ->add('image',FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])
            ->add('nb_commenter')
            ->add('Id_ouevre',EntityType::class, [
                'class' => Ouevre::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('o')
                    ->where('o.deleted_at IS  NULL') ;
                },
            ])
            ->add('categories',EntityType::class, [
                'class' => Categorie::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('c')
                    ->where('c.deleted_at IS  NULL') ;
                },
                'expanded'=>true,
                'multiple' => true,
            ])
            ->add('pay',EntityType::class, [
                'class' => Pay::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                    ->where('p.deleted_at IS  NULL') ;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}
