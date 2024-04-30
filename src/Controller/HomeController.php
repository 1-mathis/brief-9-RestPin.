<?php

namespace App\Controller;

use App\Entity\Post;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    // #[Route('/', name: 'app_home')]
    // public function index(): Response
    // {


    //     return $this->render('home/index.html.twig', [
    //         'controller_name' => 'HomeController',
    //     ]);
    // }

    #[Route('/', name: 'app_home')]
    public function affichage(EntityManagerInterface $entityManager): Response
    {

        $postRepository = $entityManager->getRepository(Post::class);

        $posts = $postRepository->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'posts' => $posts
        ]);
    }

    #[Route('/home/thread/{id}', name: 'app_post_details')]
    public function details($id, EntityManagerInterface $entityManager): Response
    {

        $postRepository = $entityManager->getRepository(Post::class);

        $post = $postRepository->find($id);

        return $this->render('home/post-details.html.twig', [
            'controller_name' => 'HomeController',
            'post' => $post
        ]);
    }
}
