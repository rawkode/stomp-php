<?php

/*
 * This file is part of the Stomp package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Stomp\Broker\Apollo;

use Stomp\Protocol\Protocol;
use Stomp\Transport\Frame;

/**
 * Apollo Stomp dialect.
 *
 * @package Stomp
 * @author András Rutkai <riskawarrior@live.com>
 */
class Apollo extends Protocol
{
    /**
     * Apollo subscribe frame.
     *
     * @param string $destination
     * @param string $subscriptionId
     * @param string $ack
     * @param string $selector
     * @param boolean $durable durable subscription
     * @return \Stomp\Transport\Frame
     */
    public function getSubscribeFrame(
        $destination,
        $subscriptionId = null,
        $ack = 'auto',
        $selector = null,
        $durable = false
    ) {
        $frame = parent::getSubscribeFrame($destination, $subscriptionId, $ack, $selector);
        if ($this->hasClientId() && $durable) {
            $frame['persistent'] = 'true';
        }
        return $frame;
    }

    /**
     * Apollo unsubscribe frame.
     *
     * @param string $destination
     * @param string $subscriptionId
     * @param bool|false $durable
     * @return \Stomp\Transport\Frame
     */
    public function getUnsubscribeFrame($destination, $subscriptionId = null, $durable = false)
    {
        $frame = parent::getUnsubscribeFrame($destination, $subscriptionId);
        if ($durable) {
            $frame['persistent'] = 'true';
        }
        return $frame;
    }
}
