<?php

namespace Egio\EgioAdmin\Model;

use Egio\EgioAdmin\Api\Data;
use Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Reflection\DataObjectProcessor;
use Egio\EgioAdmin\Model\ResourceModel\Allreinsurances as ResourceAllreinsurances;
use Egio\EgioAdmin\Model\ResourceModel\Allreinsurances\CollectionFactory as AllreinsurancesCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class AllreinsurancesRepository implements AllreinsurancesRepositoryInterface
{
    protected $resource;

    protected $allnewsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataAllnewsFactory;

    private $storeManager;

    public function __construct(
        ResourceAllreinsurances $resource,
        AllreinsurancesFactory $allnewsFactory,
        Data\AllreinsurancesInterfaceFactory $dataAllreinsurancesFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->allnewsFactory = $allnewsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataAllreinsurancesFactory = $dataAllreinsurancesFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    public function save(\Egio\EgioAdmin\Api\Data\AllreinsurancesInterface $reinsurances)
    {
        if ($reinsurances->getStoreId() === null) {
            $storeId = $this->storeManager->getStore()->getId();
            $reinsurances->setStoreId($storeId);
        }
        try {
            $this->resource->save($reinsurances);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(
                __('Could not save the news: %1', $exception->getMessage()),
                $exception
            );
        }
        return $reinsurances;
    }

    public function getById($reinsurancesId)
    {
        $reinsurances = $this->allnewsFactory->create();
        $reinsurances->load($reinsurancesId);
        if (!$reinsurances->getId()) {
            throw new NoSuchEntityException(__('News with id "%1" does not exist.', $reinsurancesId));
        }
        return $reinsurances;
    }

    public function delete(\Egio\EgioAdmin\Api\Data\AllreinsurancesInterface $reinsurances)
    {
        try {
            $this->resource->delete($reinsurances);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the news: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    public function deleteById($reinsurancesId)
    {
        return $this->delete($this->getById($reinsurancesId));
    }
}
