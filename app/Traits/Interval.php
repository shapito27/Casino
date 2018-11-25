<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:41
 */

namespace App\Traits;


trait Interval
{
    public $from;
    public $to;

    /**
     * @param int $from
     */
    public function setFrom(int $from): void
    {
        $this->from = $from;
    }

    /**
     * @param int $to
     */
    public function setTo(int $to): void
    {
        $this->to = $to;
    }

    /**
     * @return int
     */
    public function getFrom():int
    {
        return $this->from;
    }

    /**
     * @return int
     */
    public function getTo():int
    {
        return $this->to;
    }
}