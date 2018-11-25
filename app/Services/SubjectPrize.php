<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 18:50
 */

namespace App\Services;



class SubjectPrize extends Prize
{
    /** @var string  */
    protected $type = parent::SUBJECT;

    public function __construct()
    {
        parent::__construct();

        $randomSubject = (new Subject())->getRandom();
        $this->setValue($randomSubject->id);
    }

//    /**
//     * @return $this
//     * @throws \Exception
//     */
//    public function create()
//    {
//        $randomSubject = (new Subject())->getRandom();
//        $this->setValue($randomSubject->id);
//
//        return $this;
//    }
}