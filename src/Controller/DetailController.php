<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Episode;
use App\Repository\FavorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="app_detail")
     */
    public function index(Episode $episode,UserInterface $user,int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();
        $liked = $qb->select('Favorie.id')->from('App\Entity\Favorie', 'Favorie')
          ->where( 
            $qb->expr()->eq('Favorie.user', $user->getId()),
            $qb->expr()->eq('Favorie.Episode',$id) 
          )
          ->getQuery()
          ->getResult();
       

        return $this->render('detail/anime-details.html.twig', [
            'controller_name' => 'DetailController','episode' =>$episode,'Liked'=>empty($liked),
        ]);
    }


     /**
     * @Route("/detail/vote/{i}/{episode_id}", name="app_avis" ,methods={"get"})
     */
    public function vote(UserInterface $user,int $i,int $episode_id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();
        $episode = $qb->select('Episode')->from('App\Entity\Episode', 'Episode')
          ->where( 
            $qb->expr()->eq('Episode.id', $episode_id),
          )
          ->getQuery()
          ->getResult();
        $Avis = new Avis();
        $Avis->setUser($user);
        $Avis->setEpisode($episode[0]);
        $Avis->setNbEtoil($i);
        $Avis->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($Avis);
        $entityManager->flush();
        return $this->redirectToRoute('app_detail', ['id' => $episode[0]->getId()]);
        
    }
}
