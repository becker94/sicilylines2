<?php

namespace App\Controller;

use App\Entity\Periode;
use App\Form\PeriodeType;
use App\Repository\PeriodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/periode')]
class PeriodeController extends AbstractController
{
    #[Route('/', name: 'app_periode_index', methods: ['GET'])]
    public function index(PeriodeRepository $periodeRepository): Response
    {
        return $this->render('periode/index.html.twig', [
            'periodes' => $periodeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_periode_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PeriodeRepository $periodeRepository): Response
    {
        $periode = new Periode();
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $periodeRepository->save($periode, true);

            return $this->redirectToRoute('app_periode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('periode/new.html.twig', [
            'periode' => $periode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_periode_show', methods: ['GET'])]
    public function show(Periode $periode): Response
    {
        return $this->render('periode/show.html.twig', [
            'periode' => $periode,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_periode_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Periode $periode, PeriodeRepository $periodeRepository): Response
    {
        $form = $this->createForm(PeriodeType::class, $periode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $periodeRepository->save($periode, true);

            return $this->redirectToRoute('app_periode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('periode/edit.html.twig', [
            'periode' => $periode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_periode_delete', methods: ['POST'])]
    public function delete(Request $request, Periode $periode, PeriodeRepository $periodeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$periode->getId(), $request->request->get('_token'))) {
            $periodeRepository->remove($periode, true);
        }

        return $this->redirectToRoute('app_periode_index', [], Response::HTTP_SEE_OTHER);
    }
}
