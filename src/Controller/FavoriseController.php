<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Episode;
use App\Entity\Favorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavoriseController extends AbstractController
{
   
    /**
     * @Route("/favorise/new/{id}/{userid}", name="app_favorise", methods={"get"})
     */
    public function index($id,$userid): Response
    {
        $id_episode=$id;
        $entityManager = $this->getDoctrine()->getManager();
        $episode = $entityManager->find(Episode::class, $id_episode);
        $user = $entityManager->find(User::class, $userid);
        $favorise = new Favorie();
        $favorise->setUser($user);
        $favorise->setEpisode($episode);
        $favorise->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($favorise);
        $entityManager->flush();
       return $this->redirectToRoute('app_detail', ['id' => $id_episode]);

    }
}
