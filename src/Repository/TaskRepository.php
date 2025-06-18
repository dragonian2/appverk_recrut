<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

   /**
    * @return Task[] Returns an array of Task objects
    */
   public function findAllTasksWithSubtasks(): array
   {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.subTasks', 'st')
            ->addSelect('st')
            ->orderBy('t.taskIdentity', 'ASC')
            ->getQuery()
            ->getResult();
   }
}
