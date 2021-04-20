<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DetailRepository")
 * @ORM\Table(name="detail")
 * @ORM\HasLifecycleCallbacks
 */
class Detail
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=true)
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="status", type="integer", length=6, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(name="created_at", type="datetime", nullable=true, options={"default"="NULL"})
     */
    private $createdAt;

    /**
     * текущий процесс
     * @ORM\ManyToOne(targetEntity="Process", inversedBy="details")
     */
    private $process;

    /**
     * @ORM\ManyToOne(targetEntity="TechnologicalMap", inversedBy="details")
     */
    private $technologicalMap;

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

    public function getProcess()
    {
        return $this->process;
    }

    public function setProcess($process): self
    {
        $this->process = $process;

        return $this;
    }

    public function getTechnologicalMap()
    {
        return $this->technologicalMap;
    }

    public function setTechnologicalMap($technologicalMap): self
    {
        $this->technologicalMap = $technologicalMap;

        return $this;
    }
}
