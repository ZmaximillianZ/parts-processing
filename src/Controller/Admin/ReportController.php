<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Detail;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractDashboardController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/high_quality")
     */
    public function index(): Response
    {
        $sql = <<<SQL
select * from equipment where accurancy > 1;
SQL;

        $result = $this->getResultByQuery($sql, ['id', 'accurancy', 'status', 'created_at', 'name']);

        return $this->render('@EasyAdmin/high_quality.twig', ['fields' => ['max', 'sonya', 'den']]);
    }

    /**
     * @Route("equipment_load")
     */
    public function equipmentload(): Response
    {
        return $this->render('@EasyAdmin/equipment_load.twig', []);
    }

    /**
     * @Route("batch_certain_operation")
     */
    public function batchCertainOperation(): Response
    {
        return $this->render('@EasyAdmin/batch_certain_operation.twig', []);
    }

    /**
     * @Route("count_batch_by_time")
     */
    public function countBatchByTime(): Response
    {
        return $this->render('@EasyAdmin/count_batch_by_time.twig', []);
    }

    private function getResultByQuery(string $sql, array $columns)
    {
        $rsm = new ResultSetMapping();
        foreach ($columns as $column) {
            $rsm->addScalarResult((string) $column, (string) $column);
        }

        return $this->entityManager->createNativeQuery($sql, $rsm)->getResult();
    }
}
