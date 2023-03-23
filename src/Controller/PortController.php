<?php

namespace App\Controller;

use App\Entity\Port;
use App\Form\PortType;
use App\Repository\PortRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/port')]
class PortController extends AbstractController
{
    #[Route('/', name: 'app_port_index', methods: ['GET'])]
    public function index(PortRepository $portRepository): Response
    {
        return $this->render('port/index.html.twig', [
            'ports' => $portRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_port_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PortRepository $portRepository): Response
    {
        $port = new Port();
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $portRepository->save($port, true);

            return $this->redirectToRoute('app_port_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('port/new.html.twig', [
            'port' => $port,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_port_show', methods: ['GET'])]
    public function show(Port $port): Response
    {
        return $this->render('port/show.html.twig', [
            'port' => $port,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_port_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Port $port, PortRepository $portRepository): Response
    {
        $form = $this->createForm(PortType::class, $port);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $portRepository->save($port, true);

            return $this->redirectToRoute('app_port_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('port/edit.html.twig', [
            'port' => $port,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_port_delete', methods: ['POST'])]
    public function delete(Request $request, Port $port, PortRepository $portRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$port->getId(), $request->request->get('_token'))) {
            $portRepository->remove($port, true);
        }

        return $this->redirectToRoute('app_port_index', [], Response::HTTP_SEE_OTHER);
    }
}
