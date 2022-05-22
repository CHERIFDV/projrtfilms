<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Categorie;
use App\Form\CategorieType;
use App\Repository\CategorieRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{


   
    private $doctrine;
    public function __construct( ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    /**
     * @Route("/", name="app_categorie")
     */
    public function index(CategorieRepository $categorieRepository): Response
    {
        

        return $this->render('categorie/index.html.twig', [
            'Categories'=>$categorieRepository->findAll(),'episodes' => null,'ouevres'=>null,'acteurs'=>null
        ]);
    }



    /**
     * @Route("/search", name="app_categorie_search")
     */
    public function index1(Request $request,CategorieRepository $categorieRepository): Response
    {

        
        $search=$request->get('search');
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();
        $episode = $qb->select('n')->from('App\Entity\Episode', 'n')
          ->where( $qb->expr()->orX(

                   $qb->expr()->like('n.Titre', $qb->expr()->literal('%' . $search . '%')),
                   $qb->expr()->like('n.langue', $qb->expr()->literal('%' . $search . '%')),
                   $qb->expr()->like('n.Resume', $qb->expr()->literal('%' . $search . '%')),    
                   )
          )
          ->getQuery()
          ->getResult();

          $ouevre =$qb->select('o')->from('App\Entity\Ouevre', 'o')
          ->where( $qb->expr()->orX(
                   $qb->expr()->like('o.Titre', $qb->expr()->literal('%' . $search . '%')),
                   )
          )
          ->getQuery()
          ->getResult();

          $acteur =$qb->select('a')->from('App\Entity\Acteur', 'a')
          ->where( $qb->expr()->orX(
                   $qb->expr()->like('a.nom', $qb->expr()->literal('%' . $search . '%')),
                   $qb->expr()->like('a.prenom', $qb->expr()->literal('%' . $search . '%')),
                   $qb->expr()->like('a.email', $qb->expr()->literal('%' . $search . '%')),
                   )
          )
          ->getQuery()
          ->getResult();


    
        return $this->render('categorie/index.html.twig', [
            'Categories'=>$categorieRepository->findAll(),'episodes' => $episode,'ouevres'=>$ouevre,'acteurs'=>$acteur



        ]);
    }



    /**
     * @Route("/search2", name="app_categorie_search2",methods={"POST"}))
     */
    public function search(Request $request,CategorieRepository $categorieRepository): Response
    {

        
        $search=$request->get('search');
        $entityManager = $this->getDoctrine()->getManager();
        $qb = $entityManager->createQueryBuilder();
        $episode = $qb->select('n')->from('App\Entity\Episode', 'n')->leftJoin('n.categories', 'c')->leftJoin('n.Id_ouevre', 'o')->leftJoin('n.Role', 'r')->leftJoin('r.acteur', 'a')
          ->where( 
                   $qb->expr()->like('n.Titre', $qb->expr()->literal('%' . $request->get('Titre') . '%')),
                   $qb->expr()->like('n.langue', $qb->expr()->literal('%' . $request->get('Langue') . '%')),
                   $qb->expr()->like('n.Resume', $qb->expr()->literal('%' . $request->get('Resume'). '%')),
                   $qb->expr()->like('o.Titre', $qb->expr()->literal('%' . $request->get('Ouevre'). '%')),
                   /*/$qb->expr()->orX(
                        $qb->expr()->like('a.nom', $qb->expr()->literal('%' . $request->get('Acteur') . '%')),
                        $qb->expr()->like('a.prenom', $qb->expr()->literal('%' . $request->get('Acteur') . '%')),
                        )
                   ,/*/
                   $retVal = ($request->get('categorie')!= NULL) ?  $qb->expr()->eq('c.id', $request->get('categorie')) : NULL ,
          )
          ->getQuery()
          ->getResult();
          
          $ouevre =$qb->select('Ouevre')->from('App\Entity\Ouevre', 'Ouevre')
          ->where( 
                   $qb->expr()->like('Ouevre.Titre', $qb->expr()->literal('%' . $request->get('Ouevre') . '%')),
                   )
          ->getQuery()
          ->getResult();

          $acteur =$qb->select('Acteur')->from('App\Entity\Acteur', 'Acteur')
          ->where( 
                   $qb->expr()->like('Acteur.nom', $qb->expr()->literal('%' . $request->get('Acteur') . '%')),
                   $qb->expr()->like('Acteur.prenom', $qb->expr()->literal('%' . $request->get('Acteur') . '%')),
                   $qb->expr()->like('Acteur.email', $qb->expr()->literal('%' . $request->get('Acteur') . '%')),
          )
          ->getQuery()
          ->getResult();


    
        return $this->render('categorie/index.html.twig', [
              'Categories'=>$categorieRepository->findAll(),'episodes' => $episode,'ouevres'=>$ouevre,'acteurs'=>$acteur



        ]);
    }




   
    /**
     * @Route("/{id}", name="app_categorie_show", methods={"GET"})
     */
    public function show(Categorie $categorie): Response
    { 
        if (!$categorie->getDeletedAt()) {
        return $this->render('categorie/show.html.twig', [
            'categorie' => $categorie,
        ]);}
      
        return $this->render('errore/show.html.twig', [
            'categorie' => $categorie,
        ]);

    }

    /**
     * @Route("/{id}/edit", name="app_categorie_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Categorie $categorie, CategorieRepository $categorieRepository): Response
    {
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorie->setUpdatedAt(new \DateTimeImmutable());
            $categorieRepository->add($categorie);
            return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie/edit.html.twig', [
            'categorie' => $categorie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_categorie_delete", methods={"POST"})
     */
    public function delete(Request $request, Categorie $categorie, CategorieRepository $categorieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorie->getId(), $request->request->get('_token'))) {
            $categorieRepository->hide($categorie);
        }

        return $this->redirectToRoute('app_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
