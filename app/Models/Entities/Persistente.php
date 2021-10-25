<?php


namespace App\Models\Entities;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Id\UuidGenerator;

/**
 * Class Persistente
 * @package App\Models\Entities
 * @ORM\MappedSuperclass
 */
abstract class Persistente
{
    /**
     * @var string
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @ORM\Column(type="string")
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}
