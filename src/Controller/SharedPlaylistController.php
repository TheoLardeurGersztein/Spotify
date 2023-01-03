<?php

namespace App\Controller;

use App\Entity\SharedPlaylist;
use App\Form\SharedPlaylistType;
use App\Repository\SharedPlaylistRepository;
use App\Entity\Music;
use App\Entity\Membre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;


#[Route('/shared/playlist')]
class SharedPlaylistController extends AbstractController
{
    #[Route('/', name: 'app_shared_playlist_index', methods: ['GET'])]
    public function index(SharedPlaylistRepository $sharedPlaylistRepository): Response
    {
        $myPrivateSharedPlaylists = array();
        $myPublicSharedPlaylists = array();
        $user = $this->getUser();
        if($user) {
            $membre = $user->getMembre();
            $myPrivateSharedPlaylists = $sharedPlaylistRepository->findBy(
                [
                    'published' => false,
                    'creator' => $membre
                ]);
            $myPublicSharedPlaylists = $sharedPlaylistRepository->findBy(
                [
                    'published' => true,
                    'creator' => $membre
                ]);
        }
        $publicSharedPlaylists = array();
        $publicSharedPlaylists = $sharedPlaylistRepository->findBy(
            [
                'published' => true
            ]);
        $adminSharedPlaylists = array();
        if($this->isGranted('ROLE_ADMIN')) {

            $adminSharedPlaylists = $sharedPlaylistRepository->findAll();
        }
        return $this->render('shared_playlist/index.html.twig', [
            'my_private_shared_playlists' => $myPrivateSharedPlaylists,
            'my_public_shared_playlists' => $myPublicSharedPlaylists,
            'public_shared_playlists' => $publicSharedPlaylists,
            'admin_shared_playlists' => $adminSharedPlaylists,
        ]);
    }

    /**
     * @Route("/new/{id}", name="app_shared_playlist_new", methods={"GET", "POST"})
    */
    public function new(Request $request, SharedPlaylistRepository $sharedPlaylistRepository, EntityManagerInterface $entityManager, Membre $membre): Response
    {
        $sharedPlaylist = new SharedPlaylist();
        $sharedPlaylist->setCreator($membre);
        $form = $this->createForm(SharedPlaylistType::class, $sharedPlaylist);
        $form->handleRequest($request);
        

        if ($form->isSubmitted() && $form->isValid()) {
            $sharedPlaylistRepository->save($sharedPlaylist, true);

            // Make sure message will be displayed after redirect
            $this->addFlash('message', 'bian ajouté');
            // $this->addFlash() is equivalent to $request->getSession()->getFlashBag()->add()
            // or to $this->get('session')->getFlashBag()->add();

            return $this->redirectToRoute('app_shared_playlist_show', ['id' => $sharedPlaylist->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shared_playlist/new.html.twig', [
            'shared_playlist' => $sharedPlaylist,
            'form' => $form,
            'membre' => $membre,
        ]);
    }

    #[Route('/{id}', name: 'app_shared_playlist_show', methods: ['GET'])]
    public function show(SharedPlaylist $sharedPlaylist): Response
    {
        return $this->render('shared_playlist/show.html.twig', [
            'shared_playlist' => $sharedPlaylist,
            'musics' => $sharedPlaylist->getMusics(),
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shared_playlist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SharedPlaylist $sharedPlaylist, SharedPlaylistRepository $sharedPlaylistRepository): Response
    {
        $form = $this->createForm(SharedPlaylistType::class, $sharedPlaylist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $sharedPlaylistRepository->save($sharedPlaylist, true);

            return $this->redirectToRoute('app_shared_playlist_show', ['id' => $sharedPlaylist->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shared_playlist/edit.html.twig', [
            'shared_playlist' => $sharedPlaylist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shared_playlist_delete', methods: ['POST'])]
    public function delete(Request $request, SharedPlaylist $sharedPlaylist, SharedPlaylistRepository $sharedPlaylistRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sharedPlaylist->getId(), $request->request->get('_token'))) {
            $sharedPlaylistRepository->remove($sharedPlaylist, true);
        }

        return $this->redirectToRoute('app_membre_index', [], Response::HTTP_SEE_OTHER);
    }


    
    /**
     * @Route("/{shared_playlist_id}/music/{music_id}", name="app_shared_playlist_music_show", methods={"GET"})
     * @ParamConverter("sharedPlaylist", options={"id" = "shared_playlist_id"})
     * @ParamConverter("music", options={"id" = "music_id"})
     */
    public function musicShow(SharedPlaylist $sharedPlaylist, Music $music): Response
    { 
        if(! $sharedPlaylist->getMusics()->contains($music)) {
            throw $this->createNotFoundException("Couldn't find such music in this sharedPlaylist!");
        }
        if(! $sharedPlaylist->isPublished()) {
            throw $this->createAccessDeniedException("You cannot access the requested ressource!");
        }
        return $this->render('shared_playlist/music_show.html.twig', [
            'music' => $music,
            'shared_playlist' => $sharedPlaylist,
        ]);
    }



}
