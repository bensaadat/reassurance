<?php

namespace Egio\EgioAdmin\Api;

interface AllreinsurancesRepositoryInterface
{
    public function save(\Egio\EgioAdmin\Api\Data\AllreinsurancesInterface $reinsurances);

    public function getById($reinsurancesId);

    public function delete(\Egio\EgioAdmin\Api\Data\AllreinsurancesInterface $reinsurances);

    public function deleteById($reinsurancesId);
}
