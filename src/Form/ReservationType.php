<?php

namespace App\Form;

use App\Entity\Extra;
use App\Entity\Reservation;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $idRoom = $builder->getData();
        $idRoom = $idRoom->getRoom()->getId();

        $builder
            ->add('dateStart')
            ->add('dateEnd')
            ->add('extras',EntityType::class, [
                'class' => Extra::class,
                'query_builder' => function (EntityRepository $e) use($idRoom) {
                    return $e->createQueryBuilder('e')
                        ->where("e.room = :idRoom")
                        ->setParameter("idRoom",$idRoom )
                        ;
                },
                'mapped' => false
            ])
            ->add('nbPeople',null, [
                'attr' => ['class' => 'form-control'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
