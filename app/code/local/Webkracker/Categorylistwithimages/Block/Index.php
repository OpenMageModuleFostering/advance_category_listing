<?php   
class Webkracker_Categorylistwithimages_Block_Index extends Mage_Core_Block_Template{   

public function __construct()
    {
        parent::__construct();
		$storeId = Mage::app()->getStore()->getStoreId();
        $collection = Mage::getModel('catalog/category')		
        ->getCollection()
		->setStoreId($storeId)
		->addAttributeToFilter('level',2)
        ->addAttributeToSelect('*')
        ->addIsActiveFilter();
        $this->setCollection($collection);
    }


public function catConfiguration(){
	
	$config["width"] = Mage::getStoreConfig('categorywithimages/general/imagewidth')."px";
	$config["height"] = Mage::getStoreConfig('categorywithimages/general/imageheight')."px";
	$config["description"] = Mage::getStoreConfig('categorywithimages/general/description');
	$config["image"] = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA)."catalog/product/watermark/".Mage::getStoreConfig('categorywithimages/general/altimage');
	return $config;
}
 protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(10=>10,20=>20,30=>30,'all'=>'all'));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }
 public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }


}