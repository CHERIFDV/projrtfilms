<?php

namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class WatchingController extends AbstractController
{
    /**
     * @Route("/watching/{id}", name="app_watching")
     */
    public function index(EpisodeRepository $episodeRepository,int $id): Response
    {
        return $this->render('watching/anime-watching.html.twig', [
            'controller_name' => 'WatchingController','episode' => $episodeRepository->findBy(array('deleted_at' => null,"id"=>$id))[0]
        ]);
    }
}
