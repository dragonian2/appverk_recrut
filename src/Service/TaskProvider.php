<?php

namespace  App\Service;
use App\Entity\Task;
use App\Enum\Status;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


final class TaskProvider
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAll(): array
    {
        $tasks = $this->entityManager->getRepository(Task::class)->findAllTasksWithSubtasks();

        if (!$tasks) {
            throw new NotFoundHttpException('Task not found');
        }

        $data = [];
        foreach ($tasks as $task) {
            $subTasks = [];
            foreach ($task->getSubTasks() as $subTask) {
                $subTasks[] = [
                    'id' => $subTask->getTaskIdentity(),
                    'title' => $subTask->getTitle(),
                    'description' => $subTask->getDescription(),
                    'status' => Status::get($subTask->getStatus()),
                    'deadline' => $subTask->getDeadline() ? $subTask->getDeadline()->format('Y-m-d H:i:s') : null,
                    'createdAt' => $subTask->getCreatedAt() ? $subTask->getCreatedAt()->format('Y-m-d H:i:s') : null,
                ];
            }
            
            $data[] = [
                'id' => $task->getTaskIdentity(),
                'title' => $task->getTitle(),
                'description' => $task->getDescription(),
                'status' => Status::get($task->getStatus()),
                'deadline' => $task->getDeadline() ? $task->getDeadline()->format('Y-m-d H:i:s') : null,
                'createdAt' => $task->getCreatedAt() ? $task->getCreatedAt()->format('Y-m-d H:i:s') : null,
                'subTasks' => $subTasks,
                // add other fields as needed
            ];
        }

        return $data;
    }
}