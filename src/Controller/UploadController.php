<?php

namespace App\Controller;

use App\Entity\Participant;
use App\Form\UploadType;
use App\Service\CsvParticipants;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UploadController extends AbstractController
{
    /**
     * @Route("/upload", name="upload")
     */
    public function index(Request $request, CsvParticipants $csvParticipants) :Response
    {
        // Add FormatEvent
        $formAddFormatEvent = $this->createForm(UploadType::class);
        $formAddFormatEvent->handleRequest($request);
        if ($formAddFormatEvent->isSubmitted() && $formAddFormatEvent->isValid()) {
            $dataset = $formAddFormatEvent->getData();
            $csvParticipants->setPath($dataset['csvFile']->getPathName());
//            try {
            $csvParticipants->validate();
            $csvParticipants->import();
            $this->addFlash(
                'success',
                'Le nouveau format a été ajouté.'
            );
//            } catch (CsvException $csvException) {
//                $this->addFlash(
//                    'danger',
//                    $csvException->getMessage()
//                );
//            }
            return $this->redirectToRoute('participant_index');
        }
        // FormatEvents List
        $participants = $this->getDoctrine()
            ->getRepository(Participant::class);

        return $this->render('upload/index.html.twig', [
            'participants' => $participants,
            'form' => $formAddFormatEvent->createView(),
            'controller_name' => 'UploadController',
        ]);
    }
}
