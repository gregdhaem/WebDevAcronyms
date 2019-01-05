<?php

namespace App\Controller;

use App\Entity\Acronyme;
use App\Form\AcronymeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/acronyme")
 */
class AcronymeController extends AbstractController
{
    /**
     * @Route("/", name="acronyme_index", methods={"GET"})
     */
    public function index(): Response
    {
        $acronymes = $this->getDoctrine()
            ->getRepository(Acronyme::class)
            ->findAll();

        return $this->render('acronyme/index.html.twig', ['acronymes' => $acronymes]);
    }

    /**
     * @Route("/new", name="acronyme_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $acronyme = new Acronyme();
        $form = $this->createForm(AcronymeType::class, $acronyme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($acronyme);
            $entityManager->flush();

            return $this->redirectToRoute('acronyme_index');
        }

        return $this->render('acronyme/new.html.twig', [
            'acronyme' => $acronyme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acronyme_show", methods={"GET"})
     */
    public function show(Acronyme $acronyme): Response
    {
        return $this->render('acronyme/show.html.twig', ['acronyme' => $acronyme]);
    }

    /**
     * @Route("/{id}/edit", name="acronyme_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Acronyme $acronyme): Response
    {
        $form = $this->createForm(AcronymeType::class, $acronyme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acronyme_index', ['id' => $acronyme->getId()]);
        }

        return $this->render('acronyme/edit.html.twig', [
            'acronyme' => $acronyme,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="acronyme_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Acronyme $acronyme): Response
    {
        if ($this->isCsrfTokenValid('delete'.$acronyme->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($acronyme);
            $entityManager->flush();
        }

        return $this->redirectToRoute('acronyme_index');
    }
}
