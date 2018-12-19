<?php

namespace App\Controller;

use App\Entity\Subservice;
use App\Form\SubserviceType;
use App\Repository\SubserviceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subservice")
 */
class SubserviceController extends AbstractController
{
    /**
     * @Route("/", name="subservice_index", methods={"GET"})
     */
    public function index(SubserviceRepository $subserviceRepository): Response
    {
        return $this->render('subservice/index.html.twig', ['subservices' => $subserviceRepository->findAll()]);
    }

    /**
     * @Route("/new", name="subservice_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subservice = new Subservice();
        $form = $this->createForm(SubserviceType::class, $subservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subservice);
            $entityManager->flush();

            return $this->redirectToRoute('subservice_index');
        }

        return $this->render('subservice/new.html.twig', [
            'subservice' => $subservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subservice_show", methods={"GET"})
     */
    public function show(Subservice $subservice): Response
    {
        return $this->render('subservice/show.html.twig', ['subservice' => $subservice]);
    }

    /**
     * @Route("/{id}/edit", name="subservice_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Subservice $subservice): Response
    {
        $form = $this->createForm(SubserviceType::class, $subservice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subservice_index', ['id' => $subservice->getId()]);
        }

        return $this->render('subservice/edit.html.twig', [
            'subservice' => $subservice,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subservice_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Subservice $subservice): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subservice->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subservice);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subservice_index');
    }
}
