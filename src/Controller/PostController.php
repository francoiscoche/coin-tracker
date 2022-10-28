<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\PostLike;
use App\Repository\PostLikeRepository;
use Doctrine\ORM\Mapping\Entity;
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



    #[Route('/post/{id}', name:"like")]
    public function like(Post $post, ManagerRegistry $doctrine, PostLikeRepository $likeRepo) {

        $user = $this->getUser();
        $postLike = $doctrine->getRepository(PostLike::class);

        // if there is no connected user, stop the process
        if(!$user) return $this->json([
            'message' => 'unauthorized'
        ], 403);


        // if the post is already liked by the user, then it will unlike it
        if($post->isLikedByUser($user)){
            $like = $postLike->findOneBy([
                'post' => $post,
                'user' => $user
            ]);

            $doctrine->getManager()->remove($like);
            $doctrine->getManager()->flush();

            return $this->json([
                'message' => 'unlike',
                'likes' => $likeRepo->count(['post' => $post])
            ], 200);
        }


        // if the post is not liked then it will like it
        $like = new PostLike();
        $like->setPost($post)
            ->setUser($user);

        $doctrine->getManager()->persist($like);
        $doctrine->getManager()->flush();

        return $this->json([
            'message' => 'liked',
            'likes' => $likeRepo->count(['post' => $post])
        ], 200);


    }
}
