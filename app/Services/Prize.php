<?php
/**
 * Created by PhpStorm.
 * User: shapito27
 * Date: 24.11.2018
 * Time: 20:05
 */

namespace App\Services;


use App\Contracts\Convertable;

abstract class Prize
{
    /** @var int */
    protected $value;
    /** @var string type of Prize */
    protected $type;
    /** @var PrizeTransmiter */
    protected $transmiter;

    const MONEY = 'money';
    const BONUS = 'bonus';
    const SUBJECT = 'subject';

    /** @var string in this var we store last gotten prize entity */
    public const SESSION_VAR_LAST_GOTTENN_PRIZE = 'last_gottenn_prize';

    /**
     * @var Prize[]
     */
    protected static $childClasses;

    /**
     * @return string
     */
    public static function getClassName(): string
    {
        return static::class;
    }

    /**
     * Transfer prize by delegating it to Account Type
     */
    public function transfer()
    {
        $this->transmiter->run($this);
    }

    /**
     * Checck if Prize can be converted
     *
     * @return bool
     * @throws \ReflectionException
     */
    public function isConvertable()
    {
        $currentClass = new \ReflectionClass($this);

        return $currentClass->implementsInterface(Convertable::class);
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return string
     */
    protected static function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getNameForView():string
    {
        $prizeName = '';

        switch ($this->getType()) {
            case Prize::SUBJECT:
                $prizeName = Subject::findById($this->getValue())->name;
                break;
            case Prize::MONEY:
                $prizeName = $this->getValue() . ' ₽';
                break;
            case Prize::BONUS:
                $prizeName = 'бонусы ' . $this->getValue() . ' шт.';
                break;
            default:
                throw new \Exception('Type doesn`t exists yet');
        }

        return $prizeName;
    }

    /**
     * @param PrizeTransmiter $transmiter
     */
    public function setTransmiter(PrizeTransmiter $transmiter): void
    {
        $this->transmiter = $transmiter;
    }


}