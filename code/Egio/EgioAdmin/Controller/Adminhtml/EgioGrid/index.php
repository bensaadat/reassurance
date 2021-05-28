<?php

namespace Egio\EgioAdmin\Controller\Adminhtml\EgioGrid;

class Index extends \Magento\Backend\App\Action
{
    protected $resultPageFactory;

    protected $allReinsurancesFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Egio\EgioAdmin\Model\AllreinsurancesFactory $allReinsurancesFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->allReinsurancesFactory = $allReinsurancesFactory;
    }

    public function execute()
    {

        $allreinsurances = $this->allReinsurancesFactory->create();
        $reinsurancesCollection = $allreinsurances->getCollection();

        // echo '<pre>';
        // print_r($reinsurancesCollection->getData());
        // $resultPage = $this->resultPageFactory->create();

        // return $resultPage;

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('All News'));
        return $resultPage;
    }
}
