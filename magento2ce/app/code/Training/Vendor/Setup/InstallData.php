<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 6/22/2016
 * Time: 10:18 AM
 */

namespace Training\Vendor\Setup;


use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Training\Vendor\Model\ResourceModel\Vendor;
use Training\Vendor\Model\VendorFactory;

class InstallData implements InstallDataInterface
{

    /**
     * @var VendorFactory
     */
    private $vendorFactory;
    /**
     * @var Vendor
     */
    private $vendorResource;

    public function __construct(
        VendorFactory $vendorFactory,
        Vendor $vendorResource
    )
    {
        $this->vendorFactory = $vendorFactory;
        $this->vendorResource = $vendorResource;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $data = [
            'First Vendor',
            'Second Vendor',
            'Third Vendor'
        ];

        $vendorIds = [];

        foreach($data as $vendor) {
            $vendorIds[] = $this->vendorFactory->create()
                ->setVendorName($vendor)
                ->save()
                ->getId();
        }

        $relations = [];

        foreach($vendorIds as $vendorId) {
            $relations[] = ['vendor_id' => $vendorId, 'product_id' => 1];
        }

        $this->vendorResource
            ->addRelations($relations);

    }
}