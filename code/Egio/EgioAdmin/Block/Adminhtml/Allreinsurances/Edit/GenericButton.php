<?php

namespace Egio\EgioAdmin\Block\Adminhtml\Allreinsurances\Edit;

use Magento\Backend\Block\Widget\Context;
use Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class GenericButton
{
    protected $context;

    protected $allreinsurancesRepository;

    public function __construct(
        Context $context,
        AllreinsurancesRepositoryInterface $allreinsurancesRepository
    ) {
        $this->context = $context;
        $this->allreinsurancesRepository = $allreinsurancesRepository;
    }

    public function getReinsurancesId()
    {
        try {
            return $this->allreinsurancesRepository->getById(
                $this->context->getRequest()->getParam('reinsurance_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
