<?php

namespace App\Controller;

use App\Entity\Playlist;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PlaylistController extends AbstractController
{

    /**
    * Controleur Playlist
    * @Route("/playlist", name = "playlists")
    */

    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager= $doctrine->getManager();
        $playlists = $entityManager->getRepository(Playlist::class)->findAll();
    
        return $this->render('playlist/index.html.twig',
            [ 'playlists' => $playlists ]
            );
    }

    /**
     * Show a Playlist
     * 
     * @Route("/playlist/{id}", name="playlist_show", requirements={"id"="\d+"})
     *    note that the id must be an integer, above
     *    
     * @param Integer $id
     */
    public function show(ManagerRegistry $doctrine, $id)
    {
    $playlists = $doctrine->getRepository(Playlist::class);
    $playlist = $playlists->find($id);
    $musics = $playlist->getMusics();

    return $this->render('playlist/show.html.twig',
     [ 'musics' => $musics, 'playlist' => $playlist ]
     );
    }
    
}
