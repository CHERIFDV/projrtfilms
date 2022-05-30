<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Episode;
use App\Entity\Favorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FavoriseController extends AbstractController
{
   
    /**
     * @Route("/favorise/new/{id}", name="app_favorise", methods={"get"})
     */
    public function index(Episode $episode,UserInterface $user): Response
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();


        $favorise = $qb->select('Favorie')->from('App\Entity\Favorie', 'Favorie')
          ->where( 
            $qb->expr()->eq('Favorie.user', $user->getId()),
            $qb->expr()->eq('Favorie.Episode',$episode->getId()) 
          )
          ->getQuery()
          ->getResult();

        
        if (empty($favorise)) {
        
            $favorise = new Favorie();
            $favorise->setUser($user);
            $favorise->setEpisode($episode);
            $favorise->setCreatedAt(new \DateTimeImmutable());

        
            $entityManager->persist($favorise);
            $entityManager->flush();
    }else {

            $entityManager->remove($favorise[0]);
            $entityManager->flush();
        }
       





       return $this->redirectToRoute('app_detail', ['id' => $episode->getId()]);

    }

    /**
     * @Route("/favorise", name="app_favorise_get", methods={"get"})
     */
    public function getepisodeliked(UserInterface $user): Response
    {
        
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();
        

        $episodes = $qb->select('Episode')->from('App\Entity\Episode', 'Episode')->leftJoin('Episode.favories', 'Favorie')
          ->where( 
            $qb->expr()->eq('Favorie.user', $user->getId()),
          )
          ->getQuery()
          ->getResult();
     

          return $this->render('favorise/index.html.twig', [
            'episodes' => $episodes,



      ]);
    }
}
