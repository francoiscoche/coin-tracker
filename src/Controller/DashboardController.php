<?php

namespace App\Controller;

use App\Entity\Bookmark;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
class DashboardController extends AbstractController
{
    /**
     * Return user fav currency to the dashboard page
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $user = $this->getUser();

        // if there is no connected user, stop the process
        if(!$user) return $this->json([
            'message' => 'Unauthorized'
        ], 403);

        // get all fav user coins from database
        $favCoins = $doctrine->getRepository(Bookmark::class)->findBy(['user' => $user]);

        return $this->render('dashboard.html.twig', [
            'favCoins' => $favCoins,
        ]);
    }
}
