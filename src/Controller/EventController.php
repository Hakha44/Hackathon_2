<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Form\SendEmailType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event")
 */
class EventController extends AbstractController
{
    /**
     * @Route("/", name="event_index", methods={"GET"})
     */
    public function index(EventRepository $eventRepository): Response
    {
        return $this->render('event/index.html.twig', ['events' => $eventRepository->findAll()]);
    }

    /**
     * @Route("/new", name="event_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index');
        }

        return $this->render('event/new.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_show", methods={"GET"})
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', ['event' => $event]);
    }

    /**
     * @Route("/{id}/edit", name="event_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('event_index', ['id' => $event->getId()]);
        }

        return $this->render('event/edit.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Event $event): Response
    {
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($event);
            $entityManager->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * @Route("/{id}/send", name="event_send", methods={"GET","POST"})
     * @param Event $event
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return Response
     */
    public function send(Event $event, Request $request, \Swift_Mailer $mailer): Response
    {

        $form = $this->createForm(SendEmailType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des participants qui ont participés
            $participants = $event->getParticipants();
            foreach ($participants as $participant) {
                if ($participant->getPresent()) {
                    $generate_url = uniqid();
                    $generate_url = str_split($generate_url, 7);
                    $generate_url = $generate_url[0]
                    . 'A' . $event->getId()
                    . 'B' . $participant->getId()
                    . 'C' . $form->getData()['formbuilder']->getId()
                    . $generate_url[1];

                    $message = (new \Swift_Message('Votre avis suite à : ' . $event->getName()))
                        ->setFrom('matchmaking.wcs@gmail.com')
                        ->setTo($participant->getEmail())
                        ->setBody(
                            $this->renderView(
                            // templates/emails/registration.html.twig
                                'emails/sondage.html.twig',
                                ['name' => $participant->getName(), 'url' => $generate_url]
                            ),
                            'text/html'
                        )
                    ;

                    $mailer->send($message);

                    return $this->redirectToRoute('event_index');
                }

            }





//
//            var_dump($generate_url);


            //$this->getDoctrine()->getManager()->flush();

            //return $this->redirectToRoute('event_index', ['id' => $event->getId()]);
        }

        return $this->render('event/send.html.twig', [
            'event' => $event,
            'form' => $form->createView(),
        ]);
    }

}
