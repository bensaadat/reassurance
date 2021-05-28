<?php

namespace Egio\EgioAdmin\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $date;

    public function __construct(
        \Magento\Framework\Stdlib\DateTime\DateTime $date
    ) {
        $this->date = $date;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $dataAllreinsuranceRows = [
            [
                'libelle' => 'google search',
                'description' => 'this icon for search in google web site',
                'icon' => '<i class="icon-user"></i>',
                'alt' => 'icon 1',
                'statut' => 'yes',
                'ordre' => 1,
                'lien' => 'https://www.google.co.ma/',
                'title_link' => "search",
                'target_blank' => 'yes',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ],
            [
                'libelle' => 'facbook search',
                'description' => 'this icon for search in facebook web site',
                'icon' => '<i class="icon-user"></i>',
                'alt' => 'icon 2',
                'statut' => 'yes',
                'ordre' => 0,
                'lien' => 'https://www.facebook.co.ma/',
                'title_link' => "search",
                'target_blank' => 'yes',
                'updated_at' => $this->date->date(),
                'created_at' => $this->date->date()
            ]
        ];

        foreach ($dataAllreinsuranceRows as $data) {
            $setup->getConnection()->insert($setup->getTable('allreinsurances'), $data);
        }
    }
}
