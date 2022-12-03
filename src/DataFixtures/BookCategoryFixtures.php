<?php

namespace App\DataFixtures;

use App\Entity\BookCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookCategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new BookCategory())->setTitle('Android')->setSlug('Android Slug'));
        $manager->persist((new BookCategory())->setTitle('Data')->setSlug('Data Slug'));
        $manager->persist((new BookCategory())->setTitle('Net')->setSlug('Net Slug'));

        $manager->flush();
    }
}
