<?php

namespace App\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BrigadeRepository")
 * @ORM\Table(name="brigade")
 * @ORM\HasLifecycleCallbacks
 */
class Brigade
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * рабочая смена
     * @ORM\Column(name="work_shift", type="integer", length=6, nullable=true)
     */
    private $workShift;

    /**
     * @ORM\Column(name="type", type="integer", length=6, nullable=true)
     */
    private $type;

    /**
     * @ORM\Column(name="status", type="integer", length=6, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity="Worker", mappedBy="brigade")
     */
    private $workers;

    public function __toString()
    {
        return (string) $this->id ?? '';
    }

    /**
     * Gets triggered only on insert.
     *
     * @ORM\PrePersist
     */
    public function onPrePersist(): void
    {
        $this->createdAt = new DateTime('now');
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

    public function getWorkShift()
    {
        return $this->workShift;
    }

    public function setWorkShift($workShift): self
    {
        $this->workShift = $workShift;

        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setType($type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    public function setCreatedAt($createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getWorkers(): ?Collection
    {
        return $this->workers;
    }

    public function addWorker(Worker $worker): self
    {
        $this->workers[] = $worker;
        $worker->setBrigade($this);

        return $this;
    }

    public function removeWorker(Worker $worker): self
    {
        $this->workers->remove($worker);
        $worker->setBrigade(null);

        return $this;
    }
}
