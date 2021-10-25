<?php


namespace App\Models\Repositories;


use Doctrine\ORM\EntityRepository;

class RepositorioBase extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\EntityManager|\Doctrine\ORM\EntityManagerInterface
     */
    public function entityManager() {
        return $this->getEntityManager();
    }
}
