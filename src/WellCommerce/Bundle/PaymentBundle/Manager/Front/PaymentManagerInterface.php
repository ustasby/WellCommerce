<?php
/*
 * WellCommerce Open-Source E-Commerce Platform
 * 
 * This file is part of the WellCommerce package.
 *
 * (c) Adam Piotrowski <adam@wellcommerce.org>
 * 
 * For the full copyright and license information,
 * please view the LICENSE file that was distributed with this source code.
 */

namespace WellCommerce\Bundle\PaymentBundle\Manager\Front;

use WellCommerce\Bundle\OrderBundle\Entity\OrderInterface;

/**
 * Interface PaymentManagerInterface
 *
 * @author  Adam Piotrowski <adam@wellcommerce.org>
 */
interface PaymentManagerInterface
{
    /**
     * Finds order by its id or throws an exception
     *
     * @return OrderInterface
     * @throws \WellCommerce\Bundle\OrderBundle\Exception\OrderNotFoundException
     */
    public function findOrder();

    /**
     * @param OrderInterface $order
     *
     * @return \WellCommerce\Bundle\PaymentBundle\Entity\PaymentInterface
     */
    public function createPayment(OrderInterface $order);
}