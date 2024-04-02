<?php

namespace Bundle\Database\DataFixtures;

use Bundle\Database\Entity\Materials;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MaterialsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $material = new Materials();
            $material->setTitle($faker->name());
            $material->setSlug($faker->name());
            $material->setText($faker->text());
            $material->setStatus(1);
            $material->setCreatedAt(new \DateTimeImmutable('now'));
            $material->setUpdatedAt(new \DateTimeImmutable('now'));
    
            $manager->persist($material);
        }

        $manager->flush();
    }
}
