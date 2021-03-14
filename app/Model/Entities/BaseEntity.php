<?php
/**
 * Created by PhpStorm.
 * User: jirka.martinec
 * Date: 27.01.2021
 * Time: 21:55
 */

namespace App\Model\Entities;


use Nette\Database\Table\ActiveRow;
use Nette\MemberAccessException;
use Nette\SmartObject;
use Nette\Utils\DateTime;

class BaseEntity
{
    use SmartObject;

    /**
     * @var ActiveRow
     */
    private ActiveRow $data;
    /**
     * @var int
     */
    private int $id;
    /**
     * @var int
     */
    private int $system_creator;
    /**
     * @var DateTime
     */
    private DateTime $system_created;

    /**
     * Project constructor.
     * @param ActiveRow $data
     */
    public function __construct(ActiveRow $data)
    {
        $this->init($data);
    }

    protected function init(ActiveRow $data): void
    {
        $this->data = $data;

        foreach ($this->getData() as $key => $value) {
            $method = 'set' . str_replace('_', '', ucwords($key, '_'));

            try {
                $this->$method($value);
            } catch (MemberAccessException) {
            }
        }
    }

    /**
     * @return User|null
     */
    public function getCreator(): ?User
    {
        if ($this->getData()->offsetExists('system_creator')) {
            return new User($this->getData()->ref('system_creator'));
        }
        return null;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return BaseEntity
     */
    public function setId(int $id): BaseEntity
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return int
     */
    public function getSystemCreator(): int
    {
        return $this->system_creator;
    }

    /**
     * @param int $system_creator
     * @return BaseEntity
     */
    public function setSystemCreator(int $system_creator): BaseEntity
    {
        $this->system_creator = $system_creator;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getSystemCreated(): DateTime
    {
        return $this->system_created;
    }

    /**
     * @param DateTime $system_created
     * @return BaseEntity
     */
    public function setSystemCreated(DateTime $system_created): BaseEntity
    {
        $this->system_created = $system_created;
        return $this;
    }

    /**
     * @return ActiveRow
     */
    protected function getData(): ActiveRow
    {
        return $this->data;
    }
}