<?php

namespace App\Controller\Admin;

use App\Entity\Pictures;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class PicturesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Pictures::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('room'),
            ImageField::new('name')->setUploadDir("public/assets/uploads/"),
        ];
    }

}
