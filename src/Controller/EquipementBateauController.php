<?php

namespace App\Controller;

use App\Entity\EquipementBateau;
use App\Form\EquipementBateauType;
use App\Repository\EquipementBateauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/equipement/bateau')]
class EquipementBateauController extends AbstractController
{
    #[Route('/', name: 'app_equipement_bateau_index', methods: ['GET'])]
    public function index(EquipementBateauRepository $equipementBateauRepository): Response
    {
        return $this->render('equipement_bateau/index.html.twig', [
            'equipement_bateaus' => $equipementBateauRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_equipement_bateau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EquipementBateauRepository $equipementBateauRepository): Response
    {
        $equipementBateau = new EquipementBateau();
        $form = $this->createForm(EquipementBateauType::class, $equipementBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipementBateauRepository->save($equipementBateau, true);

            return $this->redirectToRoute('app_equipement_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipement_bateau/new.html.twig', [
            'equipement_bateau' => $equipementBateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_bateau_show', methods: ['GET'])]
    public function show(EquipementBateau $equipementBateau): Response
    {
        return $this->render('equipement_bateau/show.html.twig', [
            'equipement_bateau' => $equipementBateau,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_equipement_bateau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EquipementBateau $equipementBateau, EquipementBateauRepository $equipementBateauRepository): Response
    {
        $form = $this->createForm(EquipementBateauType::class, $equipementBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $equipementBateauRepository->save($equipementBateau, true);

            return $this->redirectToRoute('app_equipement_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('equipement_bateau/edit.html.twig', [
            'equipement_bateau' => $equipementBateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_equipement_bateau_delete', methods: ['POST'])]
    public function delete(Request $request, EquipementBateau $equipementBateau, EquipementBateauRepository $equipementBateauRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$equipementBateau->getId(), $request->request->get('_token'))) {
            $equipementBateauRepository->remove($equipementBateau, true);
        }

        return $this->redirectToRoute('app_equipement_bateau_index', [], Response::HTTP_SEE_OTHER);
    }
}
