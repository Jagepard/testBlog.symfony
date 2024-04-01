<?php

namespace Bundle\Blog\Controller;

use Bundle\Blog\Repository\MaterialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/', name: 'blog.index', methods: ['GET'])]
    public function index(MaterialsRepository $materialsRepository): Response
    {
        dump($materialsRepository->findAll());

        return $this->render('@Blog/blog/materials/index.html.twig', [
            'controller_name' => 'MaterialsController',
        ]);
    }
}