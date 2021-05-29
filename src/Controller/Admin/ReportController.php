<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Form\Type\BatchByTimeType;
use App\Form\Type\OperationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\ResultSetMapping;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
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
    public function highQuality(): Response
    {
        $sql = <<<SQL
select * from equipment where accurancy > 1;
SQL;
        $fields = ['id', 'accurancy', 'status', 'created_at', 'name'];
        $result = $this->getResultByQuery($sql, $fields);

        return $this->render('@EasyAdmin/high_quality.twig', ['fields' => $fields, 'data' => $result]);
    }

    /**
     * @Route("equipment_load")
     */
    public function equipmentload(): Response
    {
        $sql = <<<SQL
select e.name, SUM(wqdp.time) total_time from equipment e
left join worker_equipment we on e.id = we.equipment_id
left join worker_quipment_detail_process wqdp on we.id = wqdp.worker_equipment_id
where wqdp.time is not null
group by e.id
having SUM(wqdp.time) > 3000
order by total_time;
SQL;

        $fields = ['name', 'total_time'];
        $result = $this->getResultByQuery($sql, $fields);

        return $this->render('@EasyAdmin/equipment_load.twig', ['fields' => $fields, 'data' => $result]);
    }

    /**
     * @Route("batch_certain_operation")
     */
    public function batchCertainOperation(Request $request): Response
    {
        $sql = <<<SQL
select d.id, d.name as d_name, d.batch, e.name as e_name, we.worker_id, wqdp.created_at, wqdp.time from detail d
left join worker_quipment_detail_process wqdp on d.id = wqdp.detail_id
left join worker_equipment we on we.id = wqdp.worker_equipment_id
left join equipment e on we.equipment_id = e.id
left join process p on e.id = p.equipment_id
where p.name='%s';
SQL;
        $fields = ['id', 'd_name', 'batch', 'e_name', 'worker_id', 'created_at', 'time'];
        $form = $this->createForm(OperationType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $process = $form->getData()['Processes'];
        } else {
            $process = 'Фрезеровать (предварительно; с припуском 0.1 мм на сторону)';
        }

        $result = $this->getResultByQuery(sprintf($sql, $process), $fields);

        return $this
            ->render(
                '@EasyAdmin/batch_certain_operation.twig',
                [
                    'fields' => ['id', 'Detail', 'batch', 'Equipment', 'worker_id', 'created_at', 'time'],
                    'data' => $result,
                    'form' => $form->createView()
                ]);
    }

    /**
     * @Route("count_batch_by_time")
     */
    public function countBatchByTime(Request $request): Response
    {
        $sql = <<<SQL
select count(wqdp.detail_id) batch_count, d.batch, e.name from detail d
left join worker_quipment_detail_process wqdp on d.id = wqdp.detail_id
left join worker_equipment we on wqdp.worker_equipment_id = we.id
left join equipment e on we.equipment_id = e.id
where wqdp.created_at between '%s' and '%s'
group by d.batch, e.name;
SQL;
        $fields = ['batch_count', 'batch', 'name'];

        $form = $this->createForm(BatchByTimeType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var \DateTime $requestFrom */
            $requestFrom = $form->getData()['from'];
            /** @var \DateTime $requestTo */
            $requestTo = $form->getData()['to'];
            $from = $requestFrom->format('Y-m-d H:i:s');
            $to = $requestTo->format('Y-m-d H:i:s');
            dump($from);
        } else {
            $from = '2021-05-16 13:25:44';
            $to = '2021-05-16 15:25:44';
        }
        $result = $this->getResultByQuery(sprintf($sql, $from, $to), $fields);

        return $this
            ->render(
                '@EasyAdmin/count_batch_by_time.twig',
                [
                    'fields' => $fields,
                    'data' => $result,
                    'form' => $form->createView()
                ]
            );
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
