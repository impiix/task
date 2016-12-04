<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * @Route("/list", name="list")
     */
    public function listAction(Request $request)
    {
        $postRepository = $this->get("post.repository");
        $query = $postRepository->listAll();
        $paginator = $this->get("knp_paginator");
        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1)
        );

        return $this->render("AppBundle:Post:list.html.twig", ['pagination' => $pagination]);
    }

    /**
     * @Route("/admin", name="add")
     */
    public function addAction(Request $request)
    {
        $post = new Post("", "");
        $form = $this->createFormBuilder($post)
            ->add("title")
            ->add("content")
            ->add('add', SubmitType::class, ['label' => 'Add'])
            ->getForm();

        $form->handleRequest($request);

        $statusCode = 200;

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $postService = $this->get("post.service");
                $postService->save($post);
                $mailer = $this->get("mail.service");
                $mailer->send();

                return $this->redirectToRoute("list");
            }
            $statusCode = 400;
        }

        return new Response(
            $this->renderView("@App/post/add.html.twig", ['form' => $form->createView()]),
            $statusCode
        );
    }
}
