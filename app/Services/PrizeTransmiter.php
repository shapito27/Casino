<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 10:36
 */

namespace App\Services;


class PrizeTransmiter
{
    /** @var Transfer */
    private $transfer;

    /**
     * @param Prize $prize
     */
    public function run(Prize $prize)
    {
        $this->transfer->run();
    }

    /**
     * @param Transfer $transfer
     */
    public function setTransfer(Transfer $transfer): void
    {
        $this->transfer = $transfer;
    }
}