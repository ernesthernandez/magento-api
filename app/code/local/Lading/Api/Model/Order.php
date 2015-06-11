<?php
/**
 * Created by PhpStorm.
 * User: leo
 * Date: 6/11/15
 * Time: 5:10 PM
 */

class Lading_Api_Model_Order extends Lading_Api_Model_Abstract {

    /**
     * get order detail by order id
     * @param $order_id
     * @return array
     */
    public function getOrderById($order_id) {
        $order = Mage::getModel("sales/order")->loadByIncrementId($order_id);
        $items = array();
        foreach($order->getAllVisibleItems() as $item){
            $items[] = array(
                'created_at' => $item->getData()['created_at'],
                'updated_at' => $item->getData()['updated_at'],
                'product_id' => $item->getProductId(),
                'sku' => $item->getSku(),
                'product_type' => $item->getProductType(),
                'name' => $item->getName(),
                'price' => $item->getPrice(),
                'qty' => $item->getQtyOrdered(),
                'pic_url' => ( string ) Mage::helper('catalog/image')->init($item->getProduct(), 'thumbnail')->resize ( 250 ),
                'option'=>$item->getProductOptions()['attributes_info']
            );

        }
        $payment = array(
            'title' => $order->getPayment()->getMethodInstance()->getTitle(),
            'code' => $order->getPayment()->getMethodInstance()->getCode(),
            'card_storage' => $order->getPayment()->getCardsStorage(),
            'cards' => $order->getPayment()->getData()['method_instance']
        );
        $order_info = array (
            'order_id' => $order->getRealOrderId(),
            'created_at' => $order->getCreatedAt(),
            'full_tax_info' => $order->getFullTaxInfo(),
            'customer_name' => $order->getCustomerName(),
            'shipping_address_name' => ($order->getShippingAddress()?$order->getShippingAddress()->getName():null),
            'grand_total' => $order->getGrandTotal(),
            'status_label' => $order->getStatusLabel(),
            'shipping_method' => $order->getShippingMethod(),
            'can_ship' => $order->canShip(),
            'shipping_address' => $order->getShippingAddress()->getData(),
            'billing_address' => $order->getBillingAddress()->getData(),
            'payment_method' => $payment,
            'order_currency' => $order->getOrderCurrency()->getData(),
            'subtotal' => $order->getData()['subtotal'],
            'shipping_amount' => $order->getData()['shipping_amount'],
            'total_due' => $order->getTotalDue(),
            'items' => $items
        );
        return $order_info;
    }



    /**
     * get order detail by order id
     * @param $entity_id
     * @return array
     */
    public function getOrderByEntityId($entity_id) {
        $order = Mage::getModel("sales/order")->load($entity_id,'entity_id');
//        $items = array();
//        foreach($order->getAllVisibleItems() as $item){
//            $items[] = array(
//                'created_at' => $item->getData()['created_at'],
//                'updated_at' => $item->getData()['updated_at'],
//                'product_id' => $item->getProductId(),
//                'sku' => $item->getSku(),
//                'product_type' => $item->getProductType(),
//                'name' => $item->getName(),
//                'price' => $item->getPrice(),
//                'qty' => $item->getQtyOrdered(),
//                'pic_url' => ( string ) Mage::helper('catalog/image')->init($item->getProduct(), 'thumbnail')->resize ( 250 ),
//                'option'=>$item->getProductOptions()['attributes_info']
//            );
//
//        }
        $payment = array(
            'title' => $order->getPayment()->getMethodInstance()->getTitle(),
            'code' => $order->getPayment()->getMethodInstance()->getCode(),
            'card_storage' => $order->getPayment()->getCardsStorage(),
            'cards' => $order->getPayment()->getData()['method_instance']
        );
        $order_info = array (
            'order_id' => $order->getRealOrderId(),
            'created_at' => $order->getCreatedAt(),
            'full_tax_info' => $order->getFullTaxInfo(),
            'customer_name' => $order->getCustomerName(),
            'shipping_address_name' => ($order->getShippingAddress()?$order->getShippingAddress()->getName():null),
            'grand_total' => $order->getGrandTotal(),
            'status_label' => $order->getStatusLabel(),
            'shipping_method' => $order->getShippingMethod(),
            'can_ship' => $order->canShip(),
            'shipping_address' => $order->getShippingAddress()->getData(),
            'billing_address' => $order->getBillingAddress()->getData(),
            'payment_method' => $payment,
            'order_currency' => $order->getOrderCurrency()->getData(),
            'subtotal' => $order->getData()['subtotal'],
            'shipping_amount' => $order->getData()['shipping_amount'],
            'total_due' => $order->getTotalDue()
//            'items' => $items
        );
        return $order_info;
    }

}