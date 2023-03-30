<?php

namespace App\Controller;

use App\Entity\ReservationType;
use App\Form\ReservationTypeType;
use App\Repository\ReservationTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reservationtype')]
class ReservationTypeController extends AbstractController
{
    #[Route('/', name: 'app_reservation_type_index', methods: ['GET'])]
    public function index(ReservationTypeRepository $reservationTypeRepository): Response
    {
        return $this->render('reservation_type/index.html.twig', [
            'reservation_types' => $reservationTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_reservation_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ReservationTypeRepository $reservationTypeRepository): Response
    {
        $reservationType = new ReservationType();
        $form = $this->createForm(ReservationTypeType::class, $reservationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationTypeRepository->save($reservationType, true);

            return $this->redirectToRoute('app_reservation_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_type/new.html.twig', [
            'reservation_type' => $reservationType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_type_show', methods: ['GET'])]
    public function show(ReservationType $reservationType): Response
    {
        return $this->render('reservation_type/show.html.twig', [
            'reservation_type' => $reservationType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_reservation_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ReservationType $reservationType, ReservationTypeRepository $reservationTypeRepository): Response
    {
        $form = $this->createForm(ReservationTypeType::class, $reservationType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $reservationTypeRepository->save($reservationType, true);

            return $this->redirectToRoute('app_reservation_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reservation_type/edit.html.twig', [
            'reservation_type' => $reservationType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_reservation_type_delete', methods: ['POST'])]
    public function delete(Request $request, ReservationType $reservationType, ReservationTypeRepository $reservationTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reservationType->getId(), $request->request->get('_token'))) {
            $reservationTypeRepository->remove($reservationType, true);
        }

        return $this->redirectToRoute('app_reservation_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
