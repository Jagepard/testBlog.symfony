<?php

namespace Bundle\Admin\Model;

use Bundle\Admin\Service\ImageService;
use Bundle\Admin\Service\SlugService;
use Bundle\Database\Entity\Materials;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Bundle\Database\Repository\MaterialsRepository;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class MaterialsModel
{
    public function __construct(
        private SlugService            $slug,
        private ImageService           $imageService,
        private EntityManagerInterface $em,
        private ValidatorInterface     $validator,
        private MaterialsRepository    $repository,
    ){}

    public function create(Request $request): void
    {
        $this->imageUpload($request);
        $this->write(new Materials(), $request->request);
    }

    public function read(string $id): Materials
    {
        return $this->repository->find($id);
    }

    public function update(Request $request, $id): void
    {
        $material = $this->read($id);

        if (!empty($material->getImage() && $request->files->get('file'))) {
            $this->imageService->delete($material->getImage());
        }

        $this->imageUpload($request);
        $this->write($material, $request->request);
    }

    public function delete(string $id): void
    {
        $material = $this->read($id);

        if (!empty($material->getImage())) {
            $this->imageService->delete($material->getImage());
        }

        $this->em->remove($material);
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

    public function delimg(Request $request, $id): void
    {
        $material = $this->read($id);

        $this->imageService->delete($material->getImage());
        $request->request->set('image', '');
        $this->update($request, $id);
    }

    /**
     * @param Request $request
     * @return void
     */
    protected function imageUpload(Request $request): void
    {
        if ($request->files->has('file')) {
            $img = $request->files->get('file');

            if (!empty($img)) {
                $imgName = $img->getClientOriginalName();
                $imgName = time() . '_' . $imgName;

                $request->request->set('image', $imgName);
                $this->imageService->create($img, $imgName);
            }
        }
    }
}
