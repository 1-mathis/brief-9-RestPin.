<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PostController extends AbstractController
{


    #[Route('/post_new', name: 'app_new_post', methods: ['GET', 'POST'])]
    public function valid(EntityManagerInterface $entityManager, Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostFormType::class, $post);
        $form->handleRequest($request);
        $post->setAuthor($this->getUser());
        $post->setCreatedAt(new DateTime());
        $post->setUpdatedAt(new DateTime());
        if ($form->isSubmitted() && $form->isValid()) {

            $post = $form->getData();
            $entityManager->persist($post);
            $entityManager->flush();
            return $this->redirectToRoute('app_home');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form,
        ]);
    }
}
