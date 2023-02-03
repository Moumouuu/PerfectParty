<?php

namespace App\Controller\Admin;

use App\Entity\Extra;
use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RoomCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Room::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('description'),
            IntegerField::new('nbVoyageurMin'),
            IntegerField::new('nbVoyageurMax'),
            IntegerField::new('nbChambre'),
            IntegerField::new('nbLit'),
            IntegerField::new('nbSalleDeBain'),
            TextField::new('adresse'),
            IntegerField::new('price'),
        ];
    }
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Room) return;
        $extra = new Extra();
        $extra->setName("")->setRoom($entityInstance->getId())->setPrice(0);
        $entityInstance->addExtra($extra);

        $em->persist($extra);
        parent::persistEntity($em, $entityInstance);
    }

}
