<?php

namespace App\Controller\Admin;

use App\Entity\Extra;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExtraCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Extra::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('room'),
            TextField::new('name'),
            IntegerField::new('price'),
        ];
    }


}
