<?php

namespace App\Controller;

use App\Entity\Playlist;
use App\Form\PlaylistType;
use App\Repository\PlaylistRepository;
use App\Entity\Membre;
use App\Entity\Music;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/playlist")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class PlaylistController extends AbstractController
{
    #[Route('/', name: 'app_playlist_index', methods: ['GET'])]
    public function index(PlaylistRepository $playlistRepository): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $playlist = $playlistRepository->findAll();
        } else {
            $membre = $this->getUser()->getMembre();
            $playlist = $membre->getPlaylists();
        }
        return $this->render('playlist/index.html.twig', [
            'playlists' => $playlist,
        ]);
    }

    /**
    * @Route("/new/{id}", name="app_playlist_new", methods={"GET", "POST"})
    */
    public function new(Request $request, PlaylistRepository $playlistRepository, Membre $membre): Response
    {
        $playlist = new Playlist();
        $playlist->setMembre($membre);
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playlistRepository->save($playlist, true);

            return $this->redirectToRoute('app_membre_show', ['id' => $membre->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('playlist/new.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
            'membre' => $membre,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_show', methods: ['GET'])]
    public function show(Playlist $playlist): Response
    {
        $hasAccess = $this->isGranted('ROLE_ADMIN') ||
            ($this->getUser()->getMembre() == $playlist->getMembre());
        if(! $hasAccess) {
            throw $this->createAccessDeniedException("You cannot access another member's [inventory]!");
        }
        return $this->render('playlist/show.html.twig', [
            'playlist' => $playlist,
            'musics' => $playlist->getMusics(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_playlist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Playlist $playlist, PlaylistRepository $playlistRepository): Response
    {
        $form = $this->createForm(PlaylistType::class, $playlist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $playlistRepository->save($playlist, true);

            return $this->redirectToRoute('app_playlist_show', ['id' => $playlist->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('playlist/edit.html.twig', [
            'playlist' => $playlist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_playlist_delete', methods: ['POST'])]
    public function delete(Request $request, Playlist $playlist, PlaylistRepository $playlistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$playlist->getId(), $request->request->get('_token'))) {
            $playlistRepository->remove($playlist, true);
        }

        return $this->redirectToRoute('app_membre_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{playlist_id}/music/{music_id}", name="app_playlist_music_show", methods={"GET"})
     * @ParamConverter("playlist", options={"id" = "playlist_id"})
     * @ParamConverter("music", options={"id" = "music_id"})
     */
    public function musicShow(Playlist $playlist, Music $music): Response
    {
        return $this->render('playlist/music_show.html.twig', [
            'music' => $music,
            'playlist' => $playlist
        ]);
    }
}
