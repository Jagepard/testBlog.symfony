<?php

namespace App\Controller\Blog;

use App\Entity\Materials;
use App\EventListener\AsdListener;
use App\Interface\AsdInterface;
use App\Service\MessageGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MaterialsController extends AbstractController
{
    #[Route('/MaterialsController', name: 'app_blog_materials', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('blog/materials/index.html.twig', [
            'controller_name' => 'MaterialsController',
        ]);
    }

    #[Route('/add', name: 'app_blog_materials.add', methods: ['GET'])]
    public function add(EntityManagerInterface $em): Response
    {
        $material = new Materials();

        $material->setTitle('title');
        $material->setSlug('slug');
        $material->setStatus(1);
        $material->setCreatedAt(new \DateTimeImmutable('now'));
        $material->setUpdatedAt(new \DateTimeImmutable('now'));

        $em->persist($material);
        $em->flush();
    }

    #[Route('/products/new')]
    public function new(AsdInterface $messageGenerator, EventDispatcherInterface $eventDispatcher): Response
    {
        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);
        $eventDispatcher->dispatch($this, 'asd');
        $eventDispatcher->dispatch($this, 'afaf');

        return $this->render('blog/materials/index.html.twig', [
            'controller_name' => $message,
        ]);
    }
}
