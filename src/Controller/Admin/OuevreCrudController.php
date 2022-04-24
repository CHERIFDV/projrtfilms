<?php

namespace App\Controller\Admin;

use App\Entity\Ouevre;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class OuevreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ouevre::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Titre');
        yield NumberField::new('nb_parite');
       
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