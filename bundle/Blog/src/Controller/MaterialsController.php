<?php

namespace Bundle\Blog\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Bundle\Database\Repository\MaterialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterialsController extends AbstractController
{
    #[Route('/', name: 'blog.materials', methods: ['GET'])]
    public function index(MaterialsRepository $materialsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $materialsRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        return $this->render('@Blog/materials/materials.html.twig', ['materials' => $pagination]);
    }
}
