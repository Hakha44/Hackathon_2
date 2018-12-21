<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $theme;

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
        ]);
    }


    /**
     * @Route("/theme/{theme}", name="theme")
     */
    public function changeTheme(SessionInterface $session, string $theme)
    {
        $session->set('theme', $theme);
        return $this->redirectToRoute('home');
    }
}
