<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Episode;
use App\Entity\Commenter;
use Monolog\DateTimeImmutable;
use App\Repository\CommenterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CommenterController extends AbstractController
{

    private $commenter;
    private $doctrine;
    public function __construct(CommenterRepository $commenter,ManagerRegistry $doctrine)
    {
       $this->commenter = $commenter;
       $this->doctrine = $doctrine;
    }
    
    /**
     * @Route("/commenter", name="app_commenter")
     */
    public function index(): Response
    {
        return $this->render('commenter/index.html.twig', [
            'controller_name' => 'CommenterController',
        ]);
    }

 /**
     * @Route("/commenter/new", name="app_commenter_add", methods={"POST"})
     */
    public function add(Request $request): Response
    {

        $id_episode=$request->request->all()['id_episode'];
        $entityManager = $this->getDoctrine()->getManager();
        $episode = $entityManager->find(Episode::class, $id_episode);
        $user = $entityManager->find(User::class, $request->request->all()['id_user']);
        $Commenter = new Commenter();
        $Commenter->setMessage($request->request->all()['commenter']);
        $Commenter->setEpisode($episode);
        $Commenter->setUser($user);
        $Commenter->setNBLike(0);
        $Commenter->setCreatedAt(new \DateTimeImmutable());
        $entityManager->persist($Commenter);
        $entityManager->flush();

        return $this->redirectToRoute('app_watching', ['id' => $id_episode]);
        
    }




}
