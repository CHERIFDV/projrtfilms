<?php

namespace App\Controller;

use App\Entity\Episode;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="app_detail")
     */
    public function index(Episode $episode): Response
    {
        return $this->render('detail/anime-details.html.twig', [
            'controller_name' => 'DetailController','episode' =>$episode
        ]);
    }
}
