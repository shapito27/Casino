<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 1.12.2018
 * Time: 13:32
 */

namespace App\Services;

/**
 * Class PrizeGenerator
 * @package App\Services
 */
class PrizeGenerator
{
    /** @var Prize */
    private $prize;
    /** @var string  */
    const PRIZE_SUFFIX = 'prize';

    /**
     * @return \Illuminate\Foundation\Application|mixed
     * @throws \Exception
     */
    public function generate()
    {
        $childClasses = $this->getChildClasses();
        $prizeIndex = random_int(0, count($childClasses) - 1);
        $this->prize = app($childClasses[$prizeIndex]);

        return $this->prize;
    }

    /**
     * @return array
     */
    protected function getChildClasses(): array
    {
        $childClasses = [];

        $types = [
            Prize::MONEY,
            Prize::BONUS,
            Prize::SUBJECT,
        ];

        foreach ($types as $type) {
            $childClasses[] = $type . '.' . self::PRIZE_SUFFIX;
        }

        return $childClasses;
    }

    protected function getNamespace()
    {
        return __NAMESPACE__;
    }
}