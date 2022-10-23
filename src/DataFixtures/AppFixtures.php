<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\Artist;
use App\Entity\Album;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $theResistanceMusics = ['Uprising','Resistance','Undisclosed Desires','United States of Eurasia','Guiding Lights','Unnatural Selection','MK Ultra','I Belong to You','Exogenesis : symphony'];
        
        $theResistance = new Album();
        $theResistance->setName('The Resistance');
        $manager->persist($theResistance);

        $muse = new Artist();
        $muse->setName('Muse');
        $manager->persist($muse);


        foreach ($theResistanceMusics as $title) {
            $music = new Music();
            $music->setTitle($title);
            $music->setArtist($muse);
            $music->setYear(2009);
            $music->setAlbum($theResistance);
            $manager->persist($music);
        }
        

        $manager->flush();
    }
}
