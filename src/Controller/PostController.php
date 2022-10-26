<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{

    /**
     * Return all news
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/news', name: 'app_post')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $allPosts = $doctrine->getRepository(Post::class)->findAll();

        return $this->render('post.html.twig', [
            'allPosts' => $allPosts,
        ]);
    }
}
