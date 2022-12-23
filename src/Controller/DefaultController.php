<?php

namespace App\Controller;

use App\Entity\Room;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(EntityManagerInterface $em): Response
    {
        $rooms = $em
            ->getRepository(Room::class)
            ->findAll();
        //todo
        /*$pictures = $em
            ->getRepository(Picture::class)
            ->findAll();*/

        return $this->render('default/index.html.twig', [
            'rooms'=>$rooms,
            /*'pictures'=>$pictures*/
        ]);
    }
}
