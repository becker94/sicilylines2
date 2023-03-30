<?php

namespace App\Controller;

use App\Entity\CategorieBateau;
use App\Form\CategorieBateauType;
use App\Repository\CategorieBateauRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categoriebateau')]
class CategorieBateauController extends AbstractController
{
    #[Route('/', name: 'app_categorie_bateau_index', methods: ['GET'])]
    public function index(CategorieBateauRepository $categorieBateauRepository): Response
    {
        return $this->render('categorie_bateau/index.html.twig', [
            'categorie_bateaus' => $categorieBateauRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_categorie_bateau_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategorieBateauRepository $categorieBateauRepository): Response
    {
        $categorieBateau = new CategorieBateau();
        $form = $this->createForm(CategorieBateauType::class, $categorieBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieBateauRepository->save($categorieBateau, true);

            return $this->redirectToRoute('app_categorie_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_bateau/new.html.twig', [
            'categorie_bateau' => $categorieBateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_bateau_show', methods: ['GET'])]
    public function show(CategorieBateau $categorieBateau): Response
    {
        return $this->render('categorie_bateau/show.html.twig', [
            'categorie_bateau' => $categorieBateau,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_categorie_bateau_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CategorieBateau $categorieBateau, CategorieBateauRepository $categorieBateauRepository): Response
    {
        $form = $this->createForm(CategorieBateauType::class, $categorieBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categorieBateauRepository->save($categorieBateau, true);

            return $this->redirectToRoute('app_categorie_bateau_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('categorie_bateau/edit.html.twig', [
            'categorie_bateau' => $categorieBateau,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_categorie_bateau_delete', methods: ['POST'])]
    public function delete(Request $request, CategorieBateau $categorieBateau, CategorieBateauRepository $categorieBateauRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$categorieBateau->getId(), $request->request->get('_token'))) {
            $categorieBateauRepository->remove($categorieBateau, true);
        }

        return $this->redirectToRoute('app_categorie_bateau_index', [], Response::HTTP_SEE_OTHER);
    }
}
