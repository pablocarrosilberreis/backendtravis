<?php

namespace App\Models\Repositories;

use App\Models\Entities\Postulados\ExperienciaLaboral;

class RepositorioDeExperienciasLaborales extends RepositorioBase
{
    /**
     * @param mixed $id
     * @param null $lockMode
     * @param null $lockVersion
     * @return mixed|object|ExperienciaLaboral
     */
    public function find($id, $lockMode = null, $lockVersion = null)
    {
        return parent::find($id, $lockMode, $lockVersion);
    }

    /**
     * @return array|ExperienciaLaboral[]
     */
    public function findAll()
    {
        return parent::findAll();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param null $limit
     * @param null $offset
     * @return array|object[]|ExperienciaLaboral[]
     */
    public function findBy(array $criteria, ?array $orderBy = null, $limit = null, $offset = null)
    {
        return parent::findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @return mixed|object|ExperienciaLaboral
     */
    public function findOneBy(array $criteria, ?array $orderBy = null)
    {
        return parent::findOneBy($criteria, $orderBy);
    }

}
