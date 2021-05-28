<?php

namespace Egio\EgioAdmin\Api\Data;

interface AllreinsurancesInterface
{
    const Reinsurance_ID             = 'reinsurance_id';
    const Libelle             = 'libelle';
    const DESCRIPTION        = 'description';
    const STATUS             = 'statut';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';

    public function getId();

    public function getLibelle();

    public function getDescription();

    public function getStatus();

    public function getCreatedAt();

    public function getUpdatedAt();

    public function setId($id);

    public function setLibelle($libelle);

    public function setDescription($description);

    public function setStatus($status);

    public function setCreatedAt($created_at);

    public function setUpdatedAt($updated_at);
}
