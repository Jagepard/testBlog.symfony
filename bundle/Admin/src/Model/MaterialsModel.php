<?php

namespace Bundle\Admin\Model;

use Bundle\Admin\Service\SlugService;
use Bundle\Database\Entity\Materials;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Bundle\Database\Repository\MaterialsRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MaterialsModel
{
    public function __construct(
        private EntityManagerInterface $em, 
        private ValidatorInterface $validator, 
        private MaterialsRepository $repository, 
        private SlugService $slug
    ){}

    public function create(InputBag $post): void
    {
        $this->write(new Materials(), $post);
    }

    public function read(string $id): Materials
    {
        return $this->repository->find($id);
    }

    public function update(InputBag $post, $id): void
    {
        $this->write($this->read($id), $post);
    }

    public function delete(string $id): void
    {
        $this->em->remove($this->read($id));
        $this->em->flush();
    }

    private function write(Materials $entity, InputBag $post): void
    {
        if ($post->has('title')) {
            $entity->setTitle($post->get('title'));
            $entity->setSlug($this->slug->translit($post->get('title')));
            $entity->setStatus(1);
            $entity->setText($post->get('text'));
        }

        if ($post->has('image')) {
            $entity->setImage($post->get('image'));
        }

        if ($this->validator->validate($entity)) {
            $this->em->persist($entity);
            $this->em->flush();
        }
    }
}
