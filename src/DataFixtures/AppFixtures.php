<?php

namespace App\DataFixtures;

use App\Entity\Music;
use App\Entity\Artist;
use App\Entity\Album;
use App\Entity\Playlist;
use App\Entity\Genre;
use App\Entity\Membre;
use App\Entity\SharedPlaylist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {


        $theo = new Membre();
        $theo->setNom('Théo');
        $manager->persist($theo);
        
        $alex = new Membre();
        $alex->setNom('Alex');
        $manager->persist($alex);
        



        $likedSongs = new Playlist();
        $likedSongs->setName('Liked Songs');
        $likedSongs->setMembre($theo);
        $manager->persist($likedSongs);
        
        $myRockPlaylist = new Playlist();
        $myRockPlaylist->setName('My Rock Playlist');
        $myRockPlaylist->setMembre($theo);
        $manager->persist($myRockPlaylist);


        $pop = new Genre();
        $pop->setLabel('Pop');
        $pop->setDescription('Pop music is a genre of popular music that originated in its modern form during the mid-1950s in the United States and the United Kingdom.[4] The terms popular music and pop music are often used interchangeably, although the former describes all music that is popular and includes many disparate styles. During the 1950s and 1960s, pop music encompassed rock and roll and the youth-oriented styles it influenced. Rock and pop music remained roughly synonymous until the late 1960s, after which pop became associated with music that was more commercial, ephemeral, and accessible.');
        $manager->persist($pop);

        $rock = new Genre();
        $rock->setLabel('Rock');
        $rock->setDescription('Rock music is a broad genre of popular music that originated as "rock and roll" in the United States in the late 1940s and early 1950s, developing into a range of different styles in the mid-1960s and later, particularly in the United States and United Kingdom.[3] It has its roots in 1940s and 1950s rock and roll, a style that drew directly from the blues and rhythm and blues genres of African-American music and from country music. Rock also drew strongly from a number of other genres such as electric blues and folk, and incorporated influences from jazz, classical, and other musical styles. For instrumentation, rock has centered on the electric guitar, usually as part of a rock group with electric bass guitar, drums, and one or more singers. Usually, rock is song-based music with a 4
        4 time signature using a verse–chorus form, but the genre has become extremely diverse. Like pop music, lyrics often stress romantic love but also address a wide variety of other themes that are frequently social or political. ');
        $manager->persist($rock);

        $progressiveRock = new Genre();
        $progressiveRock->setLabel('Progressive Rock');
        $progressiveRock->setDescription('Progressive rock (shortened as prog rock or simply prog; sometimes conflated with art rock) is a broad genre of rock music[8] that developed in the United Kingdom and United States through the mid- to late 1960s, peaking in the early 1970s. Initially termed "progressive pop", the style was an outgrowth of psychedelic bands who abandoned standard pop traditions in favour of instrumentation and compositional techniques more frequently associated with jazz, folk, or classical music. Additional elements contributed to its "progressive" label: lyrics were more poetic, technology was harnessed for new sounds, music approached the condition of "art", and the studio, rather than the stage, became the focus of musical activity, which often involved creating music for listening rather than dancing. ');
        $progressiveRock->setParent($rock);
        $manager->persist($progressiveRock);

        $alternativeRock = new Genre();
        $alternativeRock->setLabel('Alternative Rock');
        $alternativeRock->setDescription('Alternative rock, or alt-rock, is a category of rock music that emerged from the independent music underground of the 1970s and became widely popular in the 1990s. "Alternative" refers to the genres distinction from mainstream or commercial rock or pop music. The terms original meaning was broader, referring to musicians influenced by the musical style or independent, DIY ethos of late-1970s punk rock.');
        $alternativeRock->setParent($rock);
        $manager->persist($alternativeRock);

        $folkRock = new Genre();
        $folkRock->setLabel('Folk Rock');
        $folkRock->setDescription('Folk rock is a hybrid music genre that combines the elements of folk and rock music, which arose in the United States, Canada, and the United Kingdom in the mid-1960s.[1][2] In the U.S., folk rock emerged from the folk music revival. Performers such as Bob Dylan and the Byrds—several of whose members had earlier played in folk ensembles—attempted to blend the sounds of rock with their pre-existing folk repertoire, adopting the use of electric instrumentation and drums in a way previously discouraged in the U.S. folk community. The term "folk rock" was initially used in the U.S. music press in June 1965 to describe the Byrds music.' );
        $folkRock->setParent($rock);
        $manager->persist($folkRock);

        $heavyMetal = new Genre();
        $heavyMetal->setLabel('Heavy Metal');
        $heavyMetal->setDescription('Heavy metal (or simply metal) is a genre of rock music that developed in the late 1960s and early 1970s, largely in the United Kingdom and United States.[2] With roots in blues rock, psychedelic rock and acid rock, heavy metal bands developed a thick, monumental sound characterized by distorted guitars, extended guitar solos, emphatic beats and loudness. ');
        $heavyMetal->setParent($rock);
        $manager->persist($heavyMetal);

        $softRock = new Genre();
        $softRock->setLabel('Soft Rock');
        $softRock->setDescription('Soft rock (also known as light rock[4] and adult-oriented rock[5]) is a derivative form of pop rock[6] that originated in the late 1960s in the U.S. region of Southern California and in the United Kingdom. The style smoothed over the edges of singer-songwriter and pop rock,[1] relying on simple, melodic songs with big, lush productions. Soft rock was prevalent on the radio throughout the 1970s and eventually metamorphosed into a form of the synthesized music of adult contemporary in the 1980s.[1] ');
        $softRock->setParent($rock);
        $manager->persist($softRock);

        $folk = new Genre();
        $folk->setLabel('Folk');
        $folk->setDescription('Contemporary folk music refers to a wide variety of genres that emerged in the mid 20th century and afterwards which were associated with traditional folk music. Starting in the mid-20th century a new form of popular folk music evolved from traditional folk music. This process and period is called the (second) folk revival and reached a zenith in the 1960s. The most common name for this new form of music is also "folk music", but is often called "contemporary folk music" or "folk revival music" to make the distinction.[1] The transition was somewhat centered in the US and is also called the American folk music revival.[2] Fusion genres such as folk rock and others also evolved within this phenomenon. While contemporary folk music is a genre generally distinct from traditional folk music, it often shares the same English name, performers and venues as traditional folk music; even individual songs may be a blend of the two. ');
        $manager->persist($folk);



        $muse = new Artist();
        $muse->setName('Muse');
        $manager->persist($muse);

        $pinkFloyd = new Artist();
        $pinkFloyd->setName('Pinf Floyd');
        $manager->persist($pinkFloyd);

        $stromae = new Artist();
        $stromae->setName('Stromae');
        $manager->persist($stromae);

        $blackSabath = new Artist();
        $blackSabath->setName('Black Sabath');
        $manager->persist($blackSabath);

        $theBeatles = new Artist();
        $theBeatles->setName('The Beatles');
        $manager->persist($theBeatles);


        
        $resistance = new Music();
        $resistance->setTitle('Resistance');
        $resistance->setArtist($muse);
        $resistance->setYear('2010');
        $resistance->addGenre($progressiveRock);
        $resistance->addPlaylist($likedSongs);
        $resistance->addPlaylist($myRockPlaylist);
        $manager->persist($resistance);

        $newBorn = new Music();
        $newBorn->setTitle('New Born');
        $newBorn->setArtist($muse);
        $newBorn->setYear('2001');
        $newBorn->addGenre($progressiveRock);
        $newBorn->addGenre($alternativeRock);
        $newBorn->addPlaylist($likedSongs);
        $newBorn->addPlaylist($myRockPlaylist);
        $manager->persist($newBorn);

        $animal = new Music();
        $animal->setTitle('Animal');
        $animal->setArtist($muse);
        $animal->setYear('2012');
        $animal->addGenre($alternativeRock);
        $animal->addPlaylist($likedSongs);
        $manager->persist($animal);

        $time = new Music();
        $time->setTitle('Time');
        $time->setArtist($pinkFloyd);
        $time->setYear('1973');
        $time->addGenre($progressiveRock);
        $time->addPlaylist($likedSongs);
        $time->addPlaylist($myRockPlaylist);
        $manager->persist($time);

        $comfortablyNumb = new Music();
        $comfortablyNumb->setTitle('Comfortably Numb');
        $comfortablyNumb->setArtist($pinkFloyd);
        $comfortablyNumb->setYear('1979');
        $comfortablyNumb->addGenre($progressiveRock);
        $comfortablyNumb->addPlaylist($likedSongs);
        $comfortablyNumb->addPlaylist($myRockPlaylist);
        $manager->persist($comfortablyNumb);

        $wishYouWereHere = new Music();
        $wishYouWereHere->setTitle('Wish You Were Here');
        $wishYouWereHere->setArtist($pinkFloyd);
        $wishYouWereHere->setYear('1975');
        $wishYouWereHere->addGenre($folkRock);
        $wishYouWereHere->addPlaylist($likedSongs);
        $manager->persist($wishYouWereHere);

        $carmen = new Music();
        $carmen->setTitle('Carmen');
        $carmen->setArtist($stromae);
        $carmen->setYear('2015');
        $carmen->addGenre($pop);
        $carmen->addPlaylist($likedSongs);
        $manager->persist($carmen);

        $ironMan = new Music();
        $ironMan->setTitle('Iron Man');
        $ironMan->setArtist($blackSabath);
        $ironMan->setYear('1971');
        $ironMan->addGenre($heavyMetal);
        $ironMan->addPlaylist($likedSongs);
        $ironMan->addPlaylist($myRockPlaylist);
        $manager->persist($ironMan);

        $paranoid = new Music();
        $paranoid->setTitle('Paranoid');
        $paranoid->setArtist($blackSabath);
        $paranoid->setYear('1970');
        $paranoid->addGenre($heavyMetal);
        $paranoid->addPlaylist($likedSongs);
        $paranoid->addPlaylist($myRockPlaylist);
        $manager->persist($paranoid);

        $blackbird = new Music();
        $blackbird->setTitle('Blackbird');
        $blackbird->setArtist($theBeatles);
        $blackbird->setYear('1968');
        $blackbird->addGenre($folk);
        $blackbird->addPlaylist($likedSongs);
        $manager->persist($blackbird);

        $help = new Music();
        $help->setTitle('Help!');
        $help->setArtist($theBeatles);
        $help->setYear('1965');
        $help->addGenre($folkRock);
        $help->addPlaylist($likedSongs);
        $manager->persist($help);

        $letItBe = new Music();
        $letItBe->setTitle('Let It Be');
        $letItBe->setArtist($theBeatles);
        $letItBe->setYear('1970');
        $letItBe->addGenre($pop);
        $letItBe->addGenre($softRock);
        $letItBe->addPlaylist($likedSongs);
        $manager->persist($letItBe);



        $theoSharedPlaylist = new SharedPlaylist();
        $theoSharedPlaylist->setDescription('Hola ceci est ma playlist que jai mis sur linternet');
        $theoSharedPlaylist->setCreator($theo);
        $theoSharedPlaylist->setPublished(true);
        $theoSharedPlaylist->addMusic($ironMan);
        $theoSharedPlaylist->addMusic($newBorn);
        $manager->persist($theoSharedPlaylist);
        

        
        

        $manager->flush();
    }
}
