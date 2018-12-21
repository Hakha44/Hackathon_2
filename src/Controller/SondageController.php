<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\FormBuilder;
use App\Entity\Participant;
use App\Entity\Sondage;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sondage")
 */
class SondageController extends AbstractController
{
    /**
     * @Route("/", name="sondage_index", methods={"GET"})
     */
    /*public function index(SondageRepository $sondageRepository): Response
    {
        return $this->render('sondage/index.html.twig', ['sondages' => $sondageRepository->findAll()]);
    }*/

    /**
     * @Route("/new/{id}", name="sondage_new", methods={"GET","POST"})
     * @param Request $request
     * @param Event $event
     * @param \Swift_Mailer $mailer
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request, Event $event, \Swift_Mailer $mailer): Response
    {
        $sondage = new Sondage();
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $formulaire = $sondage->getFormulaire();

            $participants = $event->getParticipants();

            foreach ($participants as $participant) {
                if ($participant->getPresent()) {
                    $generate_url = uniqid();

                    $sondage->setEvent($event);
                    $sondage->setParticipant($participant);
                    $sondage->setFormulaire($formulaire);
                    $sondage->setDateEnvoi(new \DateTime());
                    $sondage->setToken($generate_url);
                    $entityManager->persist($sondage);

                    $message = (new \Swift_Message('Votre avis suite à : ' . $event->getName()))
                        ->setFrom(['matchmaking.wcs@gmail.com' => 'Le Lab\'O'])
                        ->setTo($participant->getEmail())
                        ->setBody(
                            $this->renderView(
                                'emails/sondage.html.twig',
                                ['name' => $participant->getName(), 'url' => $generate_url]
                            ),
                            'text/html'
                        )
                    ;

                    $mailer->send($message);
                }
                $sondage = new Sondage();
            }

            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('sondage/new.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{slug}", name="sondage_show", methods={"GET","POST"})
     */
    public function show(string $slug, Request $request): Response
    {
        $sondage = $this->getDoctrine()->getRepository(Sondage::class)
            ->findOneBy(['token' => $slug], []);

        $formulaire = $this->getDoctrine()->getRepository(FormBuilder::class)
            ->findOneBy(['id' => $sondage->getFormulaire()],[]);

        $participant = $this->getDoctrine()->getRepository(Participant::class)
            ->findOneBy(['id' => $sondage->getParticipant()],[]);
        var_dump($request->request);
        /*$form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            var_dump()
        }*/

        //var_dump($formulaire);
        return $this->render('sondage/show.html.twig', [
            'sondage' => $sondage,
            'formulaire' => $formulaire,
            'participant' => $participant
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sondage_edit", methods={"GET","POST"})
     */
    /*public function edit(Request $request, Sondage $sondage): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index', ['id' => $sondage->getId()]);
        }

        return $this->render('sondage/edit.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
        ]);
    }*/

    /**
     * @Route("/{id}", name="sondage_delete", methods={"DELETE"})
     */
    /*public function delete(Request $request, Sondage $sondage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sondage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sondage_index');
    }*/
}
