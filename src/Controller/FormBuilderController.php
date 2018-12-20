<?php

namespace App\Controller;

use App\Entity\FormBuilder;
use App\Form\FormBuilderType;
use App\Repository\FormBuilderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/form/builder")
 */
class FormBuilderController extends AbstractController
{
    /**
     * @Route("/", name="form_builder_index", methods={"GET"})
     */
    public function index(FormBuilderRepository $formBuilderRepository): Response
    {
        return $this->render('form_builder/index.html.twig', ['form_builders' => $formBuilderRepository->findAll()]);
    }

    /**
     * @Route("/new", name="form_builder_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $formBuilder = new FormBuilder();
        $form = $this->createForm(FormBuilderType::class, $formBuilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formBuilder);
            $entityManager->flush();

            return $this->redirectToRoute('form_builder_index');
        }

        return $this->render('form_builder/new.html.twig', [
            'form_builder' => $formBuilder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_builder_show", methods={"GET"})
     */
    public function show(FormBuilder $formBuilder): Response
    {
        return $this->render('form_builder/show.html.twig', ['form_builder' => $formBuilder]);
    }

    /**
     * @Route("/{id}/edit", name="form_builder_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, FormBuilder $formBuilder): Response
    {
        $form = $this->createForm(FormBuilderType::class, $formBuilder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('form_builder_index', ['id' => $formBuilder->getId()]);
        }

        return $this->render('form_builder/edit.html.twig', [
            'form_builder' => $formBuilder,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="form_builder_delete", methods={"DELETE"})
     */
    public function delete(Request $request, FormBuilder $formBuilder): Response
    {
        if ($this->isCsrfTokenValid('delete'.$formBuilder->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($formBuilder);
            $entityManager->flush();
        }

        return $this->redirectToRoute('form_builder_index');
    }
}
