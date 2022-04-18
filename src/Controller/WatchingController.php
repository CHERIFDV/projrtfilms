<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WatchingController extends AbstractController
{
    /**
     * @Route("/watching", name="app_watching")
     */
    public function index(): Response
    {
        return $this->render('watching/anime-watching.html.twig', [
            'controller_name' => 'WatchingController',
        ]);
    }
}
