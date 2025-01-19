<?php

namespace App\Controller;

use App\Entity\Secretaire;
use App\Form\SecretaireType;
use App\Repository\SecretaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/secretaire')]
final class SecretaireController extends AbstractController
{
    #[Route(name: 'app_secretaire_index', methods: ['GET'])]
    public function index(SecretaireRepository $secretaireRepository, Request $request): Response
    {
        $page = $request->query->getInt('page', 1);

        $paginatedSecretaires = $secretaireRepository->findAllSecretaires($page);

        return $this->render('secretaire/index.html.twig', [
            'secretaires' => $paginatedSecretaires,
            'currentPage' => $page,
            'totalPages' => ceil($paginatedSecretaires->count() / SecretaireRepository::SECRETARE_PER_PAGE),
        ]);
    }

    #[Route('/new', name: 'app_secretaire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secretaire = new Secretaire();
        $form = $this->createForm(SecretaireType::class, $secretaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secretaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_secretaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secretaire/new.html.twig', [
            'secretaire' => $secretaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secretaire_show', methods: ['GET'])]
    public function show(Secretaire $secretaire): Response
    {
        return $this->render('secretaire/show.html.twig', [
            'secretaire' => $secretaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_secretaire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Secretaire $secretaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecretaireType::class, $secretaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_secretaire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('secretaire/edit.html.twig', [
            'secretaire' => $secretaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_secretaire_delete', methods: ['POST'])]
    public function delete(Request $request, Secretaire $secretaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secretaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($secretaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_secretaire_index', [], Response::HTTP_SEE_OTHER);
    }
}
