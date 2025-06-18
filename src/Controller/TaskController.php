<?php

namespace App\Controller;

use App\Service\TaskProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function __construct(private TaskProvider $taskProvider)
    {}

    // #[Route('/task', name: 'app_task')]
    // public function index(): Response
    // {
    //     return $this->render('task/index.html.twig', [
    //         'controller_name' => 'TaskController',
    //     ]);
    // }

    // #[Route('/task/{id}', name: 'app_task_show')]
    // public function showTaskAction(int $id): Response
    // {
    //     // Here you would typically fetch the task from the database using the ID
    //     // For demonstration purposes, we'll just return a simple response

    //     return $this->render('task/show.html.twig', [
    //         'task_id' => $id,
    //     ]);
    // }

    #[Route('/task/create', name: 'app_task_create')]
    public function createAction(): Response
    {
        // Logic for creating a task would go here
        // For demonstration purposes, we'll just return a simple response

        return $this->render('task/create.html.twig', [
            'message' => 'Create a new task',
        ]);
    }
    #[Route('/task/edit/{id}', name: 'app_task_edit')]
    public function editAction(int $id): Response
    {
        // Logic for editing a task would go here
        // For demonstration purposes, we'll just return a simple response

        return $this->render('task/edit.html.twig', [
            'task_id' => $id,
            'message' => 'Edit task with ID: ' . $id,
        ]);
    }
    #[Route('/task/delete/{id}', name: 'app_task_delete')]
    public function deleteAction(int $id): Response
    {
        // Logic for deleting a task would go here
        // For demonstration purposes, we'll just return a simple response

        return $this->render('task/delete.html.twig', [
            'task_id' => $id,
            'message' => 'Delete task with ID: ' . $id,
        ]);
    }
    #[Route('/task/list', methods: ['GET'], name: 'app_task_list')]
    public function listAction(): JsonResponse
    {
        return new JsonResponse($this->taskProvider->getAll(), Response::HTTP_OK);
    }
}
