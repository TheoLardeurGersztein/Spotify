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
    * @Route("/playlist")
    */

    public function index(ManagerRegistry $doctrine): Response
    {
        $htmlpage = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Welcome!</title>
    </head>
    <body>
        <h1>Liste des Playlists</h1>';

        $entityManager= $doctrine->getManager();
        $playlists = $entityManager->getRepository(Playlist::class)->findAll();
        foreach($playlists as $playlist) {
           $htmlpage .= '<li>
            <a href="/playlist/'.$playlist->getid().'">'.$playlist->getName().'</a></li>';
         }
        $htmlpage .= '</ul>';

        $htmlpage .= '</body></html>';

        return new Response(
            $htmlpage,
            Response::HTTP_OK,
            array('content-type' => 'text/html')
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
        $playlistRepo = $doctrine->getRepository(Playlist::class);
        $playlist = $playlistRepo->find($id);

        if (!$playlist) {
            throw $this->createNotFoundException('The Playlist does not exist');
        }

        $res = '<h1>' . $playlist->getName() . '<h1> <ul>';

        $musics = $playlist->getMusics();
        foreach($musics as $music) {
            $res .= '<li>' . $music->getTitle();
        }

        $res .= '<ul>';

        //$res .= '<p/><a href="' . $this->generateUrl('playlist_index') . '">Back</a>';

        return new Response('<html><body>'. $res . '</body></html>');
    }

    
}
