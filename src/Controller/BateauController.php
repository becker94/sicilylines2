<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Form\BateauType;
use App\Repository\BateauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bateau')]
class BateauController extends AbstractController
{
    #[Route('/', name: 'app_bateau_index', methods: ['GET'])]
    public function index(BateauRepository $bateauRepository): Response
    {
        return $this->render('bateau/index.html.twig', [
            'bateaus' => $bateauRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bateau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BateauRepository $bateauRepository): Response
    {
        $bateau = new Bateau();
        $form = $this->createForm(BateauType::class, $bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bateauRepository->save($bateau, true);

            return $this->redirectToRoute('app_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bateau/new.html.twig', [
            'bateau' => $bateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bateau_show', methods: ['GET'])]
    public function show(Bateau $bateau): Response
    {
        return $this->render('bateau/show.html.twig', [
            'bateau' => $bateau,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bateau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bateau $bateau, BateauRepository $bateauRepository): Response
    {
        $form = $this->createForm(BateauType::class, $bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bateauRepository->save($bateau, true);

            return $this->redirectToRoute('app_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bateau/edit.html.twig', [
            'bateau' => $bateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bateau_delete', methods: ['POST'])]
    public function delete(Request $request, Bateau $bateau, BateauRepository $bateauRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bateau->getId(), $request->request->get('_token'))) {
            $bateauRepository->remove($bateau, true);
        }

        return $this->redirectToRoute('app_bateau_index', [], Response::HTTP_SEE_OTHER);
    }
}
