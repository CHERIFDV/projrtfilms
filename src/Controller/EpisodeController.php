<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Form\EpisodeType;
use Monolog\DateTimeImmutable;
use App\Repository\EpisodeRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/episode")
 */
class EpisodeController extends AbstractController
{
    /**
     * @Route("/", name="app_episode_index", methods={"GET"})
     */
    public function index(EpisodeRepository $episodeRepository): Response
    {
        return $this->render('episode/index.html.twig', [
            'episodes' => $episodeRepository->findBy(array('deleted_at' => null)),
        ]);
    }

    /**
     * @Route("/new", name="app_episode_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EpisodeRepository $episodeRepository): Response
    {
        $episode = new Episode();
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

        ////////// add image dans /public/imgouvevre
        $images = $form->get('image')->getData();
        // On boucle sur les images
        foreach($images as $image){
        // On génère un nouveau nom de fichier
        $fichier = md5(uniqid()).'.'.$image->guessExtension();
        // On copie le fichier dans le dossier uploads
        $image->move(
            $this->getParameter('brochures_directory_image'),
            $fichier
        );}
        $episode->setImage($fichier);
             
        ///////// add episode in /public/episod/
        $urls = $form->get('url')->getData();
        // On boucle sur les images
        foreach($urls as $url){
        // On génère un nouveau nom de fichier
        $fichier = md5(uniqid()).'.'.$url->guessExtension();
        // On copie le fichier dans le dossier uploads
        $url->move(
            $this->getParameter('brochures_directory_episode'),
            $fichier
        );}

        $episode->setUrl($fichier);

        //////create_at
        $episode->setCreatedAt(new \DateTimeImmutable());
            $episodeRepository->add($episode);
            return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('episode/new.html.twig', [
            'episode' => $episode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_episode_show", methods={"GET"})
     */
    public function show(Episode $episode): Response
    {
        return $this->render('episode/show.html.twig', [
            'episode' => $episode,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_episode_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Episode $episode, EpisodeRepository $episodeRepository): Response
    {
        $form = $this->createForm(EpisodeType::class, $episode);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {


             ///////// add episode in /public/episod/
        $urls = $form->get('url')->getData();
        // On boucle sur les images
        foreach($urls as $url){
        // On génère un nouveau nom de fichier
        $fichier = md5(uniqid()).'.'.$url->guessExtension();
        // On copie le fichier dans le dossier uploads
        $url->move(
            $this->getParameter('brochures_directory_episode'),
            $fichier
        );}

        $episode->setUrl($fichier);
        
            $episode->setUpdatedAt(new \DateTimeImmutable());
            $episodeRepository->add($episode);
            return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('episode/edit.html.twig', [
            'episode' => $episode,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_episode_delete", methods={"POST"})
     */
    public function delete(Request $request, Episode $episode, EpisodeRepository $episodeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$episode->getId(), $request->request->get('_token'))) {
            $episodeRepository->hide($episode);
        }

        return $this->redirectToRoute('app_episode_index', [], Response::HTTP_SEE_OTHER);
    }
}
