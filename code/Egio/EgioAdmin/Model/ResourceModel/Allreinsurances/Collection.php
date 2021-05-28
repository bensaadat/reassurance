<?php

namespace Egio\EgioAdmin\Model\ResourceModel\Allreinsurances;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
	protected $_idFieldName = 'reinsurances_id';

	protected $_eventPrefix = 'reinsurances_allreinsurances_collection';

	protected $_eventObject = 'allreinsurances_collection';

	/**
	 * Define model & resource model
	 */
	protected function _construct()
	{
		$this->_init('Egio\EgioAdmin\Model\Allreinsurances', 'Egio\EgioAdmin\Model\ResourceModel\Allreinsurances');
	}
}
