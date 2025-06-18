<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\Status;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as PasswHash;

class AppFixtures extends Fixture
{
    public function __construct(
        private PasswHash $passwordHasher, // Inject the password hasher service
    )
    {}

    public function load(ObjectManager $manager): void
    {
        $users = [
            [
                'username' => 'user',
                'roles' => ['ROLE_USER'],
                'password' => 'haslo123',
                'isVerified' => true,
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'username' => 'admin',
                'roles' => ['ROLE_USER', 'ROLE_ADMIN'],
                'password' => 'haslo123',
                'isVerified' => true,
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        foreach ($users as $userData) {
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setRoles($userData['roles']);
            $user->setPassword($this->passwordHasher->hashPassword($user, $userData['password']));
            $user->setIsVerified($userData['isVerified']);
            $user->setCreatedAt($userData['createdAt']);
            $user->setUpdatedAt($userData['updatedAt']);

            $manager->persist($user);
        }

        $tasks = [
            [
                'taskIdentity' => 'task-1',
                'description' => 'Opis zadania 1',
                'title' => 'Zadanie 1',
                'deadline' => new \DateTime('2025-12-31'),
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-2',
                'description' => 'Opis zadania 2',
                'title' => 'Zadanie 2',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-3',
                'description' => 'Odpocznij nieco.',
                'title' => 'Odpoczynek',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-4',
                'description' => 'Bierz sie ostro do roboty',
                'title' => 'Wykonaj zadanie rekrutacyjne',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-5',
                'description' => 'Odpocznij nieco.',
                'title' => 'Odpoczynek',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-6',
                'description' => 'Bierz sie ostro do roboty',
                'title' => 'Wykonaj zadanie rekrutacyjne',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-7',
                'description' => 'Odpocznij nieco.',
                'title' => 'Odpoczynek',
                'deadline' => null,
                'status' => Status::get('odrzucony'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'task-8',
                'description' => 'Bierz sie ostro do roboty',
                'title' => 'Wykonaj zadanie rekrutacyjne',
                'deadline' => null,
                'status' => Status::get('odrzucony'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        $subTasks1 = [
            [
                'taskIdentity' => 'subtask-1',
                'description' => 'Opis podzadania 1',
                'title' => 'Podzadanie 1',
                'deadline' => new \DateTime('2025-12-31'),
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'subtask-2',
                'description' => 'Opis podzadania 2',
                'title' => 'Podzadanie 2',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        $subTasks2 = [
            [
                'taskIdentity' => 'subtask-3',
                'description' => 'Opis podzadania 3',
                'title' => 'Podzadanie 3',
                'deadline' => new \DateTime('2025-08-30'),
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
            [
                'taskIdentity' => 'subtask-4',
                'description' => 'Opis podzadania 4',
                'title' => 'Podzadanie 4',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        $subTasks3 = [
            [
                'taskIdentity' => 'subtask-5',
                'description' => 'Opis podzadania 5',
                'title' => 'Podzadanie 5',
                'deadline' => null,
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        $subTasks4 = [
            [
                'taskIdentity' => 'subtask-6',
                'description' => 'Opis podzadania 6',
                'title' => 'Podzadanie 6',
                'deadline' => new \DateTime('2025-11-22'),
                'status' => Status::get('oczekujący'),
                'createdAt' => new \DateTimeImmutable(),
                'updatedAt' => null,
            ],
        ];

        foreach ($tasks as $taskData) {
            $task = new \App\Entity\Task();
            $task->setTaskIdentity($taskData['taskIdentity']);
            $task->setDescription($taskData['description']);
            $task->setTitle($taskData['title']);
            $task->setDeadline($taskData['deadline']);
            $task->setStatus($taskData['status']);
            $task->setCreatedAt($taskData['createdAt']);
            $task->setUpdatedAt($taskData['updatedAt']);

            if ($taskData['taskIdentity'] == 'task-1') {
                foreach ($subTasks1 as $subTaskData) {
                    $subTask = new \App\Entity\SubTask();
                    $subTask->setTaskIdentity($subTaskData['taskIdentity']);
                    $subTask->setDescription($subTaskData['description']);
                    $subTask->setTitle($subTaskData['title']);
                    $subTask->setDeadline($subTaskData['deadline']);
                    $subTask->setStatus($subTaskData['status']);
                    $subTask->setCreatedAt($subTaskData['createdAt']);
                    $subTask->setUpdatedAt($subTaskData['updatedAt']);
                    $subTask->setTask($task);

                    $manager->persist($subTask);
                    $task->addSubTask($subTask);
                }
            }

            if ($taskData['taskIdentity'] == 'task-2') {
                foreach ($subTasks2 as $subTaskData) {
                    $subTask = new \App\Entity\SubTask();
                    $subTask->setTaskIdentity($subTaskData['taskIdentity']);
                    $subTask->setDescription($subTaskData['description']);
                    $subTask->setTitle($subTaskData['title']);
                    $subTask->setDeadline($subTaskData['deadline']);
                    $subTask->setStatus($subTaskData['status']);
                    $subTask->setCreatedAt($subTaskData['createdAt']);
                    $subTask->setUpdatedAt($subTaskData['updatedAt']);
                    $subTask->setTask($task);

                    $manager->persist($subTask);
                    $task->addSubTask($subTask);
                }
            }

            if ($taskData['taskIdentity'] == 'task-5') {
                foreach ($subTasks3 as $subTaskData) {
                    $subTask = new \App\Entity\SubTask();
                    $subTask->setTaskIdentity($subTaskData['taskIdentity']);
                    $subTask->setDescription($subTaskData['description']);
                    $subTask->setTitle($subTaskData['title']);
                    $subTask->setDeadline($subTaskData['deadline']);
                    $subTask->setStatus($subTaskData['status']);
                    $subTask->setCreatedAt($subTaskData['createdAt']);
                    $subTask->setUpdatedAt($subTaskData['updatedAt']);
                    $subTask->setTask($task);

                    $manager->persist($subTask);
                    $task->addSubTask($subTask);
                }
            }

            if ($taskData['taskIdentity'] == 'task-6') {
                foreach ($subTasks4 as $subTaskData) {
                    $subTask = new \App\Entity\SubTask();
                    $subTask->setTaskIdentity($subTaskData['taskIdentity']);
                    $subTask->setDescription($subTaskData['description']);
                    $subTask->setTitle($subTaskData['title']);
                    $subTask->setDeadline($subTaskData['deadline']);
                    $subTask->setStatus($subTaskData['status']);
                    $subTask->setCreatedAt($subTaskData['createdAt']);
                    $subTask->setUpdatedAt($subTaskData['updatedAt']);
                    $subTask->setTask($task);

                    $manager->persist($subTask);
                    $task->addSubTask($subTask);
                }
            }
            
            $manager->persist($task);
        }

        $manager->flush();
    }
}
