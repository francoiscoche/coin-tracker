<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/news', name: 'app_')]
class PostController extends AbstractController
{

    /**
     * Return all news
     *
     * @param ManagerRegistry $doctrine
     * @return Response
     */
    #[Route('/', name: 'post')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $allPosts = $doctrine->getRepository(Post::class)->findAll();

        return $this->render('post.html.twig', [
            'allPosts' => $allPosts,
        ]);
    }



    #[Route('/{slug}', name: "slug")]
    /**
     * Undocumented function
     *
     * @param ManagerRegistry $doctrine
     * @param string $slug
     * @return void
     */
    public function getNewsBySlug(ManagerRegistry $doctrine, $slug = null) {

        $getNewsById = $doctrine->getRepository(Post::class)->findOneBy(["slug" => $slug]);

        return $this->render('post-detail.html.twig', [
            'newsById' => $getNewsById
        ]);
    }
}
