<?php

namespace Bundle\Admin\Controller;

use Bundle\Admin\Model\MaterialsModel;
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

    #[Route('/material/add', name: 'add', methods: ['GET'])]
    public function add(): Response
    {
        return $this->render('@Admin/materials/add.html.twig');
    }

    #[Route('/material/create', name: 'create', methods: ['POST'])]
    public function create(Request $request, MaterialsModel $model): Response
    {
        if ($this->isCsrfTokenValid('add', $request->getPayload()->get('token'))) {
            $model->create($request);
        }

        return $this->redirectToRoute('admin.index');
    }

    #[Route('/material/edit/{id}', name: 'edit', methods: ['GET'])]
    public function edit(MaterialsRepository $materialsRepository, $id): Response
    {
        $material = $materialsRepository->find($id);

        return $this->render('@Admin/materials/edit.html.twig', [
            'material' => $material
        ]);
    }

    #[Route('/material/update/{id}', name: 'update', methods: ['POST'])]
    public function update(Request $request, MaterialsModel $model, $id): Response
    {
        if ($this->isCsrfTokenValid('update', $request->getPayload()->get('token'))) {
            $model->update($request->request, $id);
        }

        return $this->redirectToRoute('admin.index');
    }

    #[Route('/material/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(MaterialsModel $model, $id): Response
    {
        $model->delete($id);
        return $this->redirectToRoute('admin.index');
    }
}
