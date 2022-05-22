<?php

namespace App\Controller\Admin;

use App\Entity\Acteur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ActeurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Acteur::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield TextField::new('prenom');
        yield EmailField::new('email');
        if (Crud::PAGE_NEW === $pageName||Crud::PAGE_INDEX === $pageName) {
            yield ImageField::new('image')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
            ->setBasePath('acteur/')
            ->setUploadDir('public/acteur/');
     } elseif (Crud::PAGE_EDIT=== $pageName) {
        yield ImageField::new('image')->setUploadedFileNamePattern('[slug]-[contenthash].[extension]')
        ->setBasePath('acteur/')
        ->setUploadDir('public/acteur/')->setSortable(false)
        ->setFormTypeOption('required' ,false);
     }
        
        $created_at = DateTimeField::new('created_at');
        $updated_at = DateTimeField::new('updated_at');
        $deleted_at = DateTimeField::new('deleted_at');



                    if(Crud::PAGE_NEW === $pageName){
                       /// yield $created_at->setFormTypeOption('data', new \DateTimeImmutable());
                       // yield $updated_at->setFormTypeOption('disabled', true);
                    }else{
                    if (Crud::PAGE_EDIT === $pageName) {
                       // yield $created_at->setFormTypeOption('disabled', true);
                        ///yield $updated_at->setFormTypeOption('data', new \DateTimeImmutable());
                    } else {
                        yield $created_at;
                        yield $updated_at;
                        yield $deleted_at;
                    }}
       
    }
    
}
