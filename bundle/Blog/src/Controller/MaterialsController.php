<?php

namespace Bundle\Blog\Controller;

use Bundle\Blog\Service\SlugService;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Bundle\Database\Repository\MaterialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/', name: 'blog.')]
class MaterialsController extends AbstractController
{
    #[Route('/', name: 'materials', methods: ['GET'])]
    public function index(MaterialsRepository $materialsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $materialsRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            20 /*limit per page*/
        );

        return $this->render('@Blog/materials/materials.html.twig', ['materials' => $pagination]);
    }

    #[Route('/material/{slug}', name: 'item', methods: ['GET'])]
    public function item(MaterialsRepository $materialsRepository, SlugService $slugService, $slug): Response
    {
        $material = $materialsRepository->find($slugService->getIdFromSlug($slug));
        
        return $this->render('@Blog/materials/item.html.twig', ['material' => $material]);
    }
}
