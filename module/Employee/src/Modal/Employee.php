<?php


namespace Employee\Modal;
/**
 * Class Employee
 * @package Employee\Modal
 */
class Employee
{
    /**
     * Gender list
     */
    public const GENDER_LIST = [
        'M' => 'Male',
        'F' => 'Female'
    ];

    /**
     * Department list
     */
    public const DEPARTMENT_LIST = [
        'PHP' => 'PHP',
        'UI' => 'UI',
        'Admin' => 'Admin',
        'Account' => 'Account',
    ];

    /**
     * Skill set
     */
    public const SKILL_LIST = [
        'PHP' => 'PHP',
        'jQuery' => 'jQuery',
        'MySql' => 'MySql',
        'Finance' => 'Finance',
    ];

    /** @var int|null */
    protected $id;

    /** @var string|null */
    protected $firstName;

    /** @var string|null */
    protected $lastName;

    /** @var string|null */
    protected $birthDate;

    /** @var string|null */
    protected $gender;

    /** @var string|null */
    protected $department;

    /** @var string|null */
    protected $skills;

    /**
     * @param array $data
     */
    public function exchangeArray(array $data): void
    {
        $this->id = $data['id'];
        $this->firstName = $data['firstName'];
        $this->lastName = $data['lastName'];
        $this->birthDate = $data['birthDate'];
        $this->gender = $data['gender'];
        $this->department = $data['department'];
        $this->skills = is_array($data['skills']) ? json_encode($data['skills']) : json_decode($data['skills']);
    }

    /**
     * Convert data to json
     *
     * @return array
     */
    public function getArrayCopy(): array
    {
        return [
            'id' => $this->getId(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'birthDate' => $this->getBirthDate(),
            'gender' => $this->getGender(),
            'department' => $this->getDepartment(),
            'skills' => $this->getSkills(),
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * @return string|null
     */
    public function getBirthDate(): ?string
    {
        return $this->birthDate;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Get formatted gender
     *
     * @return string|null
     */
    public function getGenderFormatted(): ?string
    {
        return self::GENDER_LIST[$this->getGender()] ?? '';
    }

    /**
     * @return string|null
     */
    public function getDepartment(): ?string
    {
        return $this->department;
    }

    /**
     * @return string|null
     */
    public function getSkills()
    {
        return $this->skills;
    }
}
