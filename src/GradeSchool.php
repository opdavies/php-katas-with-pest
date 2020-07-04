<?php

declare(strict_types=1);

namespace App;

use Assert\Assert;
use Tightenco\Collect\Support\Collection;

final class GradeSchool
{
    private Collection $students;

    public function __construct()
    {
        $this->students = new Collection();
    }

    public function addStudentToGrade(string $name, int $grade): void
    {
        Assert::that($name)->notEmpty('Name cannot be blank');

        Assert::that($grade)
            ->greaterOrEqualThan(1, 'Grade must be greater than or equal to 1');

        $this->students->push(['name' => $name, 'grade' => $grade]);
    }

    public function getAllStudents(): Collection
    {
        return $this->students->pluck('grade')
            ->unique()
            ->map(fn (int $grade): Collection => new Collection([
                'grade' => $grade,
                'students' => $this->getStudentsByGrade($grade),
            ]))
            ->sortBy('grade')
            ->values();
    }

    public function getStudentsByGrade(int $grade): Collection
    {
        return $this->students
            ->filter(fn (array $student): bool => $grade == $student['grade'])
            ->pluck('name')
            ->sort()
            ->values();
    }
}
