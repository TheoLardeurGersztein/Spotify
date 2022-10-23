<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\Artist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $TheResistance = ['Uprising','Resistance','Undisclosed Desires','United States of Eurasia','Guiding Lights','Unnatural Selection','MK Ultra','I Belong to You','Exogenesis : symphony'];
        

        $artist = new Artist();
        $artist->setName('Muse');
        $manager->persist($artist);


        foreach ($TheResistance as $title) {
            $music = new Music();
            $music->setTitle($title);
            $music->setArtist($artist);
            $music->setYear(2009);
            $manager->persist($music);
        }
        

        $manager->flush();
    }
}
