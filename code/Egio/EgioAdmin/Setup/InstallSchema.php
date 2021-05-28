<?php

namespace Egio\EgioAdmin\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

  public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
  {

    $newsTableName = $setup->getTable('allreinsurances');

    if ($setup->getConnection()->isTableExists($newsTableName) != true) {

      $newsTable = $setup->getConnection()
        ->newTable($newsTableName)
        ->addColumn(
          'reinsurance_id',
          \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
          null,
          ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
          'Reinsurance ID'
        )
        ->addColumn(
          'libelle',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          null,
          ['nullable' => true],
          'libelle'
        )
        ->addColumn(
          'description',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          null,
          ['nullable' => true],
          'description'
        )
        ->addColumn(
          'icon',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          255,
          ['nullable' => false],
          'icon'
        )
        ->addColumn(
          'alt',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          255,
          ['nullable' => true, 'default' => ''],
          'alt'
        )
        ->addColumn(
          'statut',
          \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
          null,
          ['nullable' => false, 'unsigned' => true],
          'status'
        )
        ->addColumn(
          'ordre',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          255,
          ['nullable' => false, 'default' => ''],
          'ordre'
        )
        ->addColumn(
          'lien',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          100,
          ['nullable' => true, 'default' => ''],
          'lien'
        )
        ->addColumn(
          'title_link',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          255,
          ['nullable' => true, 'default' => ''],
          'title_link'
        )
        ->addColumn(
          'target_blank',
          \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
          255,
          ['nullable' => true, 'default' => ''],
          'target_blank'
        )
        ->addColumn(
          'created_at',
          \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
          null,
          ['nullable' => false],
          'Created At'
        )
        ->addColumn(
          'updated_at',
          \Magento\Framework\DB\Ddl\Table::TYPE_DATETIME,
          null,
          ['nullable' => false],
          'Updated At'
        )
        ->setComment("allreinsurances Table");

      $setup->getConnection()->createTable($newsTable);
    }
  }
}
