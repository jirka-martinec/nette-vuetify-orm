<?php
/**
 * Created by PhpStorm.
 * User: jirka.martinec
 * Date: 27.12.2020
 * Time: 21:34
 */

namespace App\Model\Repositories;


use Nette\Database\Explorer;
use Nette\Database\Table\ActiveRow;
use Nette\Database\Table\Selection;
use Nette\InvalidArgumentException;
use Nette\SmartObject;
use Nette\Utils\ArrayHash;

abstract class BaseRepository
{
    use SmartObject;

    /**
     * @var Explorer
     */
    protected Explorer $database;
    /**
     * @var string
     */
    protected string $entityClass;

    /**
     * BaseModel constructor.
     * @param Explorer $database
     */
    public function __construct(Explorer $database)
    {
        $this->database = $database;

        if (!isset($this->entityClass)) {
            throw new InvalidArgumentException("Variable \$entityClass is not set in " . get_class($this) . ".");
        }
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function findEntityById(int $id): mixed
    {
        if ($row = $this->findById($id)) {
            return new $this->entityClass($row);
        }
        throw new InvalidArgumentException("{$this->entityClass} with \$id '{$id}' does not exist.");
    }

    /**
     * @param array $where
     * @return array
     */
    public function findAllEntities(array $where = []): array
    {
        $entities = [];
        $result = $this->findAll($where);
        foreach ($result as $row) {
            $entities[] = new $this->entityClass($row);
        }
        return $entities;
    }

    /**
     * @param ArrayHash $values
     * @return iterable|int|ActiveRow|bool|Selection
     */
    public function insert(ArrayHash $values): iterable|int|ActiveRow|bool|Selection
    {
        return $this->findAll()->insert($values);
    }

    /**
     * @param array $where
     * @return Selection
     */
    protected function findAll(array $where = []): Selection
    {
        $result = $this->database->table(static::TABLE);
        return empty($where) ? $result : $result->where($where);
    }

    /**
     * @param int $id
     * @return ActiveRow|null
     */
    protected function findById(int $id): ?ActiveRow
    {
        return $this->findAll()->get($id);
    }
}