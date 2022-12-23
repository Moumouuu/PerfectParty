<?php

namespace App\Controller;

use App\Entity\Extra;
use App\Form\ExtraType;
use App\Repository\ExtraRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/extra')]
class ExtraController extends AbstractController
{
    #[Route('/', name: 'app_extra_index', methods: ['GET'])]
    public function index(ExtraRepository $extraRepository): Response
    {
        return $this->render('extra/index.html.twig', [
            'extras' => $extraRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_extra_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ExtraRepository $extraRepository): Response
    {
        $extra = new Extra();
        $form = $this->createForm(ExtraType::class, $extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $extraRepository->save($extra, true);

            return $this->redirectToRoute('app_extra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('extra/new.html.twig', [
            'extra' => $extra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extra_show', methods: ['GET'])]
    public function show(Extra $extra): Response
    {
        return $this->render('extra/show.html.twig', [
            'extra' => $extra,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_extra_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Extra $extra, ExtraRepository $extraRepository): Response
    {
        $form = $this->createForm(ExtraType::class, $extra);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $extraRepository->save($extra, true);

            return $this->redirectToRoute('app_extra_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('extra/edit.html.twig', [
            'extra' => $extra,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_extra_delete', methods: ['POST'])]
    public function delete(Request $request, Extra $extra, ExtraRepository $extraRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$extra->getId(), $request->request->get('_token'))) {
            $extraRepository->remove($extra, true);
        }

        return $this->redirectToRoute('app_extra_index', [], Response::HTTP_SEE_OTHER);
    }
}
