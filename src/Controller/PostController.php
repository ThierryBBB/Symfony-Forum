<?php

namespace App\Controller;

use App\Repository\PostRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PostController extends AbstractController
{
    /**
     * @Route("/", name="post-list")
     * @param PostRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(PostRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $postList = $paginator->paginate(
            $repository->getAll(),
            $request->query->getInt('page', 1),
            15
        );
        return $this->render('post/index.html.twig', [
            'postlist' => $postList,
        ]);
    }
}
