<?php

namespace App\Controller;

use App\Entity\Music;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class MusicController extends AbstractController
{

    /**
    * Controleur Music
    * @Route("/music", name = "musics")
    */

    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager= $doctrine->getManager();
        $musics = $entityManager->getRepository(Music::class)->findAll();
    
        return $this->render('music/index.html.twig',
            [ 'musics' => $musics ]
            );
    }

    /**
     * Show a music
     * 
     * @Route("/music/{id}", name="music_show", requirements={"id"="\d+"})
     *    note that the id must be an integer, above
     *    
     * @param Integer $id
     */
    public function show(ManagerRegistry $doctrine, $id)
    {

        $musics = $doctrine->getRepository(Music::class);
        $music = $musics->find($id);

    return $this->render('music/show.html.twig',
     [ 'music' => $music ]
     );
    }
    
}
