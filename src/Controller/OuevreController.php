<?php

namespace App\Controller;

use App\Entity\Ouevre;
use App\Form\OuevreType;
use Monolog\DateTimeImmutable;
use App\Repository\OuevreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/ouevre")
 */
class OuevreController extends AbstractController
{
    /**
     * @Route("/", name="app_ouevre_index", methods={"GET"})
     */
    public function index(OuevreRepository $ouevreRepository): Response
    {
        return $this->render('ouevre/index.html.twig', [
            'ouevres' => $ouevreRepository->findBy(array('deleted_at' => null)),
        ]);
    }

    /**
     * @Route("/new", name="app_ouevre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, OuevreRepository $ouevreRepository): Response
    {
        $ouevre = new Ouevre();
        $form = $this->createForm(OuevreType::class, $ouevre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ouevre->setCreatedAt(new \DateTimeImmutable());
            $ouevreRepository->add($ouevre);
            return $this->redirectToRoute('app_ouevre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouevre/new.html.twig', [
            'ouevre' => $ouevre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ouevre_show", methods={"GET"})
     */
    public function show(Ouevre $ouevre): Response
    {
        return $this->render('ouevre/show.html.twig', [
            'ouevre' => $ouevre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_ouevre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Ouevre $ouevre, OuevreRepository $ouevreRepository): Response
    {
        $form = $this->createForm(OuevreType::class, $ouevre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $ouevre->setUpdatedAt(new \DateTimeImmutable());
            $ouevreRepository->add($ouevre);
            return $this->redirectToRoute('app_ouevre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ouevre/edit.html.twig', [
            'ouevre' => $ouevre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_ouevre_delete", methods={"POST"})
     */
    public function delete(Request $request, Ouevre $ouevre, OuevreRepository $ouevreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$ouevre->getId(), $request->request->get('_token'))) {
            $ouevreRepository->hide($ouevre);
        }

        return $this->redirectToRoute('app_ouevre_index', [], Response::HTTP_SEE_OTHER);
    }
}
