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

////    private $code;
//
//    /** @var string Name of prize */
//    protected $displayName;
    /** @var AccountType strategy for transfer prize */
    protected $accountType;
//    /** @var User */
//    public $user;
    /** @var int */
    public $value;

    /** @var string type of Prize */
    protected $type;

    const MONEY = 'money';
    const BONUS = 'bonus';
    const SUBJECT = 'subject';

    /**
     * @var Prize[]
     */
    protected static $childClasses;
//
//
//
    /**
     * Prize constructor.
     */
    public function __construct()
    {
        $this->setAccountType();
    }

    /**
     * @return string
     */
    public static function getClassName(): string
    {
        return static::class;
    }

    /**
     * Transfer prize by delegating it to Account Type
     * @param Services\User $user
     */
    public function transfer(int $userId)
    {
        $this->accountType->transfer($this, $userId);
    }

    /**
     * refuse prize by delegating it to Account Type
     * @param Services\User $user
     */
    public function refuse(\App\Services\User $user)
    {
        $this->accountType->refuse($user);
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
     */
    protected function setAccountType(): void
    {
        $namespace = self::getNamespace();
        $accountTypeClassName = $namespace . '\\' . ucfirst($this->type) . AccountType::ACCOUNT_TYPE_SUFIX;

        $this->accountType = (new \ReflectionClass($accountTypeClassName))->newInstance();
    }

    /**
     * @return AccountType
     */
    public function getAccountType(): AccountType
    {
        return $this->accountType;
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

//    abstract protected function create();

    /**
     * @return mixed
     * @throws \Exception
     */
    public static function generateRandomPrize()
    {
        $childClasses = self::getChildClasses();
        $prizeIndex = random_int(0, count($childClasses) - 1);

//        $randomPrize = new self::$childClasses[$prizeIndex];
//
//        return $randomPrize->create();
        return new $childClasses[$prizeIndex];
    }

    protected static function getNamespace()
    {
        return __NAMESPACE__;
    }

    protected static function getChildClasses()
    {
        $childClasses = [];
        $namespace = self::getNamespace();

        $types = [
            self::MONEY,
            self::BONUS,
            self::SUBJECT,
        ];

        foreach ($types as $type) {
            $childClasses[] = $namespace . '\\' . ucfirst($type) . 'Prize';
        }

        return $childClasses;
    }


}