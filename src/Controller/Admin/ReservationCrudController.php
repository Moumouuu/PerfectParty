<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use Doctrine\ORM\Mapping\Id;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user'),
            AssociationField::new('room'),
            DateField::new('dateStart'),
            DateField::new('dateEnd'),
            IntegerField::new('totalPrice'),
            IntegerField::new('nbPeople'),

        ];
    }

}
