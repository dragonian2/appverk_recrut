<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class RootController extends AbstractController
{
    private const TASKS_TEMPLATE = 'contents/tasks.html.twig';
    private const NO_ACCESS_TEMPLATE = 'contents/noaccess.html.twig';

    #[Route('/', name: 'app_root')]
    public function index(): Response
    {
        $isAdmin = $this->isGranted('ROLE_ADMIN');
        $isUser = $this->isGranted('ROLE_USER');

        if ($isAdmin) {
            return $this->render(self::TASKS_TEMPLATE);
        } elseif ($isUser) {
            return $this->render(self::NO_ACCESS_TEMPLATE);
        }

        return $this->redirectToRoute('app_about');
    }

    #[Route('/about', name: 'app_about')]
    public function about(): Response
    {
        return $this->render('contents/about.html.twig');
    } 
}
