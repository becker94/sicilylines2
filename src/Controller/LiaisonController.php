<?php

namespace App\Controller;

use App\Entity\Liaison;
use App\Form\LiaisonType;
use App\Repository\LiaisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/liaison')]
class LiaisonController extends AbstractController
{
    #[Route('/', name: 'app_liaison_index', methods: ['GET'])]
    public function index(LiaisonRepository $liaisonRepository): Response
    {
        return $this->render('liaison/index.html.twig', [
            'liaisons' => $liaisonRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liaison_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LiaisonRepository $liaisonRepository): Response
    {
        $liaison = new Liaison();
        $form = $this->createForm(LiaisonType::class, $liaison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $liaisonRepository->save($liaison, true);

            return $this->redirectToRoute('app_liaison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liaison/new.html.twig', [
            'liaison' => $liaison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liaison_show', methods: ['GET'])]
    public function show(Liaison $liaison): Response
    {
        return $this->render('liaison/show.html.twig', [
            'liaison' => $liaison,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liaison_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Liaison $liaison, LiaisonRepository $liaisonRepository): Response
    {
        $form = $this->createForm(LiaisonType::class, $liaison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $liaisonRepository->save($liaison, true);

            return $this->redirectToRoute('app_liaison_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liaison/edit.html.twig', [
            'liaison' => $liaison,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liaison_delete', methods: ['POST'])]
    public function delete(Request $request, Liaison $liaison, LiaisonRepository $liaisonRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$liaison->getId(), $request->request->get('_token'))) {
            $liaisonRepository->remove($liaison, true);
        }

        return $this->redirectToRoute('app_liaison_index', [], Response::HTTP_SEE_OTHER);
    }
}
