<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class RootController extends AbstractController
{
    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        return $this->render('contents/about.html.twig', []);
    }
}
