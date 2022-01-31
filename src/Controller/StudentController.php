<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route("/student", name="student")
     */
    public function index(): Response
    {
        return $this->render('student/index.html.twig', [
            'controller_name1' => 'Fourat',
            'controller_name2' => 'Nada',
            'controller_name3' => 'Khaled',
        ]);
    }

    /**
     * @Route("/student2", name="student2")
     */
    public function index2(): Response
    {
        return new Response("Bonjour Bonjour");
    }
}
