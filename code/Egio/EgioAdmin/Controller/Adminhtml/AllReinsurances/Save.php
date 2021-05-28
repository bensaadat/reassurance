<?php

namespace Egio\EgioAdmin\Controller\Adminhtml\AllReinsurances;

use Magento\Backend\App\Action;
use Egio\EgioAdmin\Model\Allreinsurances;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Egio\EgioAdmin\Model\AllreinsurancesFactory
     */
    private $allreinsurancesFactory;

    /**
     * @var \Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface
     */
    private $allreinsurancesRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Egio\EgioAdmin\Model\AllEgioAdminFactory $allreinsurancesFactory
     * @param \Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface $allreinsurancesRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Egio\EgioAdmin\Model\AllreinsurancesFactory $allreinsurancesFactory = null,
        \Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface $allreinsurancesRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->allreinsurancesFactory = $allreinsurancesFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Egio\EgioAdmin\Model\AllreinsurancesFactory::class);
        $this->allreinsurancesRepository = $allreinsurancesRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Egio\EgioAdmin\Api\AllreinsurancesRepositoryInterface::class);
        parent::__construct($context);
    }

    /**
     * Authorization level
     *
     * @see _isAllowed()
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Egio_EgioAdmin::save');
    }

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Allreinsurances::STATUS_ENABLED;
            }
            if (empty($data['reinsurances_id'])) {
                $data['reinsurances_id'] = null;
            }

            /** @var \Egio\EgioAdmin\Model\Allreinsurances $model */
            $model = $this->allreinsurancesFactory->create();

            $id = $this->getRequest()->getParam('reinsurances_id');
            if ($id) {
                try {
                    $model = $this->allreinsurancesRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This EgioAdmin no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'reinsurances_allreinsurances_prepare_save',
                ['allreinsurances' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->allreinsurancesRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the EgioAdmin.'));
                $this->dataPersistor->clear('reinsurances_allreinsurances');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['reinsurances_id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?: $e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the reinsurances.'));
            }

            $this->dataPersistor->set('reinsurances_allreinsurances', $data);
            return $resultRedirect->setPath('*/*/edit', ['reinsurances_id' => $this->getRequest()->getParam('reinsurances_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
