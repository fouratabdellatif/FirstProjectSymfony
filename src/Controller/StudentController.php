<?php

namespace App\Controller;

use App\Entity\Student;
use App\Form\StudentType;
use App\Repository\StudentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'controller_name' => 'StudentController',
        ]);
    }

    /**
     * @Route("/student/list", name="list_student")
     */
    public function getAllStudents(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Student::class);
        $list = $repo->findAll();
        return $this->render('student/list.html.twig', [
            'list' => $list,
        ]);
    }

    /**
     * @Route("/student/list/get/{id}", name="get_student")
     */
    public function getStudent($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Student::class);
        $student = $repo->find($id);
        return $this->render('student/student.html.twig', [
            'student' => $student,
        ]);
    }

    /**
     * @Route("/student/list/addStudent", name="add_student")
     */
    public function addStudent(Request $req): Response
    {
        $s = new Student();
        $form = $this->createForm(StudentType::class, $s);
        /*$s->setName($name);*/
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($s);
            $em->flush();
            return $this->redirectToRoute("list_student");
        }
        return $this->render('student/add.html.twig', [
            'myForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/student/list/updateStudent/{id}", name="update_student")
     */
    public function updateStudent($id, Request $req): Response
    {
        $repo = $this->getDoctrine()->getRepository(Student::class);
        $s = $repo->find($id);
        $form = $this->createForm(StudentType::class, $s);
        /*$s->setName($name);*/
        $form->handleRequest($req);
        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute("list_student");
        }
        return $this->render('student/add.html.twig', [
            'myForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/student/list/deleteStudent/{id}", name="delete_student")
     */
    public function deleteStudent($id, StudentRepository $repo): Response
    {
        $s = $repo->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($s);
        $em->flush();
        return $this->redirectToRoute("list_student");
        /*return $this->render('student/student.html.twig', [
            'student' => $s,
        ]);*/
    }
}
