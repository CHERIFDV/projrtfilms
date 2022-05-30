<?php

namespace App\Controller\Admin;

use App\Entity\Ouevre;
use App\Entity\Episode;
use App\Entity\Categorie;
use Doctrine\ORM\QueryBuilder;
use Monolog\DateTimeImmutable;
use App\Admin\Field\VichImageField;
use App\Repository\EpisodeRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EpisodeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Episode::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
     
       
        yield TextField::new('Titre');
        yield TimeField::new('Duree');

        if (Crud::PAGE_INDEX === $pageName) {
            yield TextareaField::new('Resume')->onlyOnDetail();
        } else {
            yield TextareaField::new('Resume');
        }




        yield TextField::new('Realise');
        if (Crud::PAGE_NEW === $pageName||Crud::PAGE_INDEX === $pageName) {
                yield ImageField::new('url', 'url')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setBasePath('episode/') ->setUploadDir('public/episode/');
                yield ImageField::new('image')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
                ->setBasePath('imgouvevre/')
                ->setUploadDir('public/imgouvevre/');
         } elseif (Crud::PAGE_EDIT=== $pageName) {
            yield ImageField::new('url', 'url')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setBasePath('episode/')->setUploadDir('public/episode/')->setSortable(false)
            ->setFormTypeOption('required' ,false);
            yield ImageField::new('image')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setBasePath('imgouvevre/')
            ->setUploadDir('public/imgouvevre/')->setSortable(false)
            ->setFormTypeOption('required' ,false);
         }
        yield NumberField::new('Nb_view');
        yield TextField::new('langue');
        yield NumberField::new('Numero_episode');
        yield TextField::new('langue');
       
        yield NumberField::new('nb_commenter');
        
        yield AssociationField::new('categories')->setQueryBuilder(
            fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Categorie::class)->findBy(array('deleted_at' => null))
        );
        yield AssociationField::new('Id_ouevre')->setQueryBuilder(
            fn (QueryBuilder $queryBuilder) => $queryBuilder->getEntityManager()->getRepository(Ouevre::class)->findBy(array('deleted_at' => null))
        );
       



        
        $created_at = DateTimeField::new('created_at');
        $updated_at = DateTimeField::new('updated_at');
        $deleted_at = DateTimeField::new('deleted_at');


        if(Crud::PAGE_NEW === $pageName){
            yield $created_at->setFormTypeOption('data', new \DateTimeImmutable());
            yield $updated_at->setFormTypeOption('disabled', true);
        }else{
        if (Crud::PAGE_EDIT === $pageName) {
            yield $created_at->setFormTypeOption('disabled', true);
            yield $updated_at->setFormTypeOption('data', new \DateTimeImmutable());
        } else {
            yield $created_at;
            yield $updated_at;
            yield $deleted_at;
        }}
      
    }















    
}
