<?php

namespace App\Controller\Admin;

use App\Entity\Relai;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RelaiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Relai::class;
    }
    public function createNewEntity() : Relai
    {
        return new Relai();
    }
    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            AssociationField::new('adresse'),
            TextField::new('nomRelai'),
        ];
    }
    
}
