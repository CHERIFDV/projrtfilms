<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        
        yield TextField::new('email');
        yield TextField::new('Nom');
        yield TextField::new('Prenom');
        // VichImageField::new('image');
        



    if (Crud::PAGE_NEW === $pageName||Crud::PAGE_INDEX === $pageName) {
        yield ImageField::new('image', 'Image')
        ->setBasePath('users/')
        ->setUploadDir('public/users/');
     } elseif (Crud::PAGE_EDIT=== $pageName) {
        yield ImageField::new('image', 'Image')
        ->setBasePath('users/')
        ->setUploadDir('public/users/')
        ->setFormTypeOption('required' ,false);
        
     }
        yield ChoiceField::new('roles')->setChoices([
            'ROLE_ADMIN' => 'ROLE_ADMIN',
            'ROLE_USER' => 'ROLE_USER',
        ])->allowMultipleChoices();;
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
