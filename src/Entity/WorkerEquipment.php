<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WorkerEquipmentRepository")
 * @ORM\Table(name="worker_equipment")
 * @ORM\HasLifecycleCallbacks
 */
class WorkerEquipment
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="qualification", type="float", length=6, nullable=true)
     */
    private $qualification;

    /**
     * @ORM\ManyToOne(targetEntity="Worker", inversedBy="workerEquipments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $worker;

    /**
     * @ORM\ManyToOne(targetEntity="Equipment", inversedBy="workerEquipments", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $equipment;

    /**
     * @ORM\OneToMany(targetEntity="WorkerEquipmentDetailProcess", mappedBy="workerEquipment")
     */
    private $workerEquipmentDetailProcesses;

    #[Pure]
    public function __construct()
    {
        $this->equipment = new Equipment();
        $this->worker = new Worker();
    }

    public function __toString()
    {
        $user = $this->worker ? $this->worker->getUser() : null;

        return sprintf(
            '%s(qualification: %s), equipment:%s',
            $user ? $user->getFirstName() : '',
            (string) $this->qualification,
                $this->equipment
        ) ?? '';
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getQualification()
    {
        return $this->qualification;
    }

    public function setQualification($qualification): self
    {
        $this->qualification = $qualification;

        return $this;
    }

    public function getWorker()
    {
        return $this->worker;
    }

    public function setWorker($worker): self
    {
        $this->worker = $worker;

        return $this;
    }

    public function getEquipment()
    {
        return $this->equipment;
    }

    public function setEquipment($equipment): self
    {
        $this->equipment = $equipment;

        return $this;
    }

    public function getWorkerEquipmentDetailProcesses(): ?Collection
    {
        return $this->workerEquipmentDetailProcesses;
    }

    public function addWorkerEquipmentDetailProcesses(WorkerEquipmentDetailProcess $process): self
    {
        $this->workerEquipmentDetailProcesses[] = $process;

        return $this;
    }

    public function removeWorkerEquipmentDetailProcesses(WorkerEquipmentDetailProcess $process): self
    {
        $this->workerEquipmentDetailProcesses->remove($process);
        $process->setWorkerEquipment(null);

        return $this;
    }
}
