<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 19:02
 */

namespace App\Services;

use App\Exceptions\IntervalAlreadyExistException;
use App\Exceptions\IsNotChildOfPrizeException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PrizeInterval
{
    /** @var int */
    protected $id;
    /** @var string */
    protected $name;
    /** @var Prize */
    protected $prizeType;
    /** @var int */
    protected $from;
    /** @var int */
    protected $to;
    /** @var int */
    protected $modifiedBy;

    public function __construct(string $prizeTypeClassName)
    {
        if(!(new \ReflectionClass($prizeTypeClassName))->isSubclassOf(Prize::class)){
            throw new IsNotChildOfPrizeException();
        }

        if(Prize::getClassName() === $prizeTypeClassName){
           throw new IsNotChildOfPrizeException();
        }

        $this->prizeType = $prizeTypeClassName;
    }

    /**
     * @param string $name
     * @param string $prizeTypeClassName
     * @param int $from
     * @param int $to
     * @param int $userId
     * @throws IntervalAlreadyExistException
     * @throws IsNotChildOfPrizeException
     */
    public static function createInterval(string $name, string $prizeTypeClassName, int $from, int $to, int $userId)
    {
        $searchedInterval = new PrizeInterval($prizeTypeClassName);
        if ($searchedInterval->findIntervalByPrizeType() === null) {
            $newInterval = new \App\Models\PrizeInterval();
            $newInterval->name = $name;
            $newInterval->prize_type = $prizeTypeClassName;
            $newInterval->from = $from;
            $newInterval->to = $to;
            $newInterval->modified_by = $userId;
            $newInterval->save();
        }else{
            throw new IntervalAlreadyExistException();
        }
    }

    /**
     * @return $this|null
     */
    public function findIntervalByPrizeType()
    {
        try{
            $interval = \App\Models\PrizeInterval::where('prize_type', $this->prizeType)->firstOrFail();
            $this->id = $interval->id;
            $this->name = $interval->name;
            $this->prize_type = $interval->prize_type;
            $this->from = $interval->from;
            $this->to = $interval->to;
            $this->modifiedBy = $interval->modifiedBy;

            return $this;
        }catch (ModelNotFoundException $exception ){
            return null;
        }
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

}