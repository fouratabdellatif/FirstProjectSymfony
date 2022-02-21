<?php

namespace App\Controller;

use App\Entity\Classroom;
use App\Repository\ClassroomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClassroomController extends AbstractController
{
    /**
     * @Route("/classroom", name="classroom")
     */
    public function index(): Response
    {
        return $this->render('classroom/index.html.twig', [
            'controller_name' => 'ClassroomController',
        ]);
    }

    /**
     * @Route("/classroom/list", name="list_classroom")
     */
    public function getAllClasses(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Classroom::class);
        $list = $repo->findAll();
        return $this->render('classroom/list.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/classroom/list/get/{id}", name="get_class")
     */
    public function getClass($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Classroom::class);
        $class = $repo->find($id);
        return $this->render('classroom/class.html.twig', [
            'class' => $class,
        ]);
    }

    /**
     * @Route("/classroom/list/addClass/{name}", name="add_class")
     */
    public function addClassroom($name): Response
    {
        $c = new Classroom();
        $c->setName($name);
        $em = $this->getDoctrine()->getManager();
        $em->persist($c);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
        /*return $this->render('classroom/class.html.twig', [
            'class' => $c,
        ]);*/
    }

    /**
     * @Route("/classroom/list/deleteClass/{id}", name="delete_class")
     */
    public function deleteClassroom($id, ClassroomRepository $repo): Response
    {
        $c = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($c);
        $em->flush();
        return $this->redirectToRoute("list_classroom");
        /*return $this->render('classroom/class.html.twig', [
            'class' => $c,
        ]);*/
    }
}