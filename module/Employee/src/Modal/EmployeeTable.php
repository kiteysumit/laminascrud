<?php


namespace Employee\Modal;

use Laminas\Db\ResultSet\ResultSet;
use Laminas\Db\TableGateway\TableGatewayInterface;

/**
 * Class EmployeeTable
 * @package Employee\Modal
 */
class EmployeeTable
{
    /** @var TableGatewayInterface */
    protected $tableGateway;

    /**
     * EmployeeTable constructor.
     * @param TableGatewayInterface $tableGateway
     */
    public function __construct(TableGatewayInterface $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * Fetch all records
     *
     * @return ResultSet
     */
    public function fetchAll(): ResultSet
    {
        return $this->tableGateway->select();
    }

    /**
     * @param int $id
     * @return
     */
    public function fetchById(int $id)
    {
        $data = $this->tableGateway->select(['id' => $id]);

        return $data->current();
    }

    /**
     * @param Employee $employee
     * @return mixed
     */
    public function insertModel(Employee $employee)
    {
        return $this->tableGateway->insert($employee->getArrayCopy());
    }

    /**
     * @param Employee $employee
     * @return mixed
     */
    public function updateModel(Employee $employee)
    {
        return $this->tableGateway->update($employee->getArrayCopy(), ['id' => $employee->getId()]);
    }
}
