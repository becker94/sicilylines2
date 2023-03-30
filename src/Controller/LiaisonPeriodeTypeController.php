<?php

namespace App\Controller;

use App\Entity\LiaisonPeriodeType;
use App\Form\LiaisonPeriodeTypeType;
use App\Repository\LiaisonPeriodeTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/liaisonperiodetype')]
class LiaisonPeriodeTypeController extends AbstractController
{
    #[Route('/', name: 'app_liaison_periode_type_index', methods: ['GET'])]
    public function index(LiaisonPeriodeTypeRepository $liaisonPeriodeTypeRepository): Response
    {
        return $this->render('liaison_periode_type/index.html.twig', [
            'liaison_periode_types' => $liaisonPeriodeTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_liaison_periode_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LiaisonPeriodeTypeRepository $liaisonPeriodeTypeRepository): Response
    {
        $liaisonPeriodeType = new LiaisonPeriodeType();
        $form = $this->createForm(LiaisonPeriodeTypeType::class, $liaisonPeriodeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $liaisonPeriodeTypeRepository->save($liaisonPeriodeType, true);

            return $this->redirectToRoute('app_liaison_periode_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liaison_periode_type/new.html.twig', [
            'liaison_periode_type' => $liaisonPeriodeType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liaison_periode_type_show', methods: ['GET'])]
    public function show(LiaisonPeriodeType $liaisonPeriodeType): Response
    {
        return $this->render('liaison_periode_type/show.html.twig', [
            'liaison_periode_type' => $liaisonPeriodeType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_liaison_periode_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LiaisonPeriodeType $liaisonPeriodeType, LiaisonPeriodeTypeRepository $liaisonPeriodeTypeRepository): Response
    {
        $form = $this->createForm(LiaisonPeriodeTypeType::class, $liaisonPeriodeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $liaisonPeriodeTypeRepository->save($liaisonPeriodeType, true);

            return $this->redirectToRoute('app_liaison_periode_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('liaison_periode_type/edit.html.twig', [
            'liaison_periode_type' => $liaisonPeriodeType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_liaison_periode_type_delete', methods: ['POST'])]
    public function delete(Request $request, LiaisonPeriodeType $liaisonPeriodeType, LiaisonPeriodeTypeRepository $liaisonPeriodeTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$liaisonPeriodeType->getId(), $request->request->get('_token'))) {
            $liaisonPeriodeTypeRepository->remove($liaisonPeriodeType, true);
        }

        return $this->redirectToRoute('app_liaison_periode_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
