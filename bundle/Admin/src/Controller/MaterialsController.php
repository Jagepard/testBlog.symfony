<?php

namespace Bundle\Admin\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Bundle\Database\Repository\MaterialsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin', name: 'admin.')]
class MaterialsController extends AbstractController
{
    #[Route('', name: 'index', methods: ['GET'])]
    public function index(MaterialsRepository $materialsRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $pagination = $paginator->paginate(
            $materialsRepository->findAll(), /* query NOT result */
            $request->query->getInt('page', 1), /*page number*/
            10 /*limit per page*/
        );

        return $this->render('@Admin/materials/index.html.twig', ['materials' => $pagination]);
    }

    #[Route('/material/add', name: 'add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        if ($request->isMethod('post')) {
            dd($request->request->all());
        }

        return $this->render('@Admin/materials/add.html.twig');
    }
}
