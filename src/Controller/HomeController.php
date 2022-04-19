<?php

namespace App\Controller;

use App\Repository\EpisodeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(EpisodeRepository $episodeRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',   'episodes' => $episodeRepository->findBy(array('deleted_at' => null)),
        ]);
    }
}
