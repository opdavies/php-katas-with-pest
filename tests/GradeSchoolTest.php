<?php

declare(strict_types=1);

use App\GradeSchool;
use Assert\AssertionFailedException;

beforeEach(function (): void {
    $this->school = new GradeSchool();
});

it('gets all students', function (): void {
    $this->school->addStudentToGrade('Anna', 1);
    $this->school->addStudentToGrade('Jim', 2);
    $this->school->addStudentToGrade('Charlie', 3);

    $expected = [
        ['grade' => 1, 'students' => ['Anna']],
        ['grade' => 2, 'students' => ['Jim']],
        ['grade' => 3, 'students' => ['Charlie']],
    ];

    assertSame($expected, $this->school->getAllStudents()->toArray());
});

it('can get students by grade', function (): void {
    $this->school->addStudentToGrade('Jim', 2);

    assertSame(['Jim'], $this->school->getStudentsByGrade(2)->toArray());
});

it('should order grades numerically', function (): void {
    $this->school->addStudentToGrade('Anna', 1);
    $this->school->addStudentToGrade('Charlie', 3);
    $this->school->addStudentToGrade('Jim', 2);
    $this->school->addStudentToGrade('Harry', 4);

    $expected = [
        ['grade' => 1, 'students' => ['Anna']],
        ['grade' => 2, 'students' => ['Jim']],
        ['grade' => 3, 'students' => ['Charlie']],
        ['grade' => 4, 'students' => ['Harry']],
    ];

    assertSame($expected, $this->school->getAllStudents()->toArray());
});

it('names within a grade are ordered alphabetically', function (): void {
    $this->school->addStudentToGrade('Charlie', 1);
    $this->school->addStudentToGrade('Barb', 1);
    $this->school->addStudentToGrade('Anna', 1);

    $this->school->addStudentToGrade('Peter', 2);
    $this->school->addStudentToGrade('Alex', 2);
    $this->school->addStudentToGrade('Zoe', 2);

    $expected = [
        [
            'grade' => 1,
            'students' => ['Anna', 'Barb', 'Charlie'],
        ],
        [
            'grade' => 2,
            'students' => ['Alex', 'Peter', 'Zoe'],
        ]
    ];

    assertSame($expected, $this->school->getAllStudents()->toArray());
});

test('name cannot be empty', function (): void {
    $this->school->addStudentToGrade('', 1);
})->throws(
    AssertionFailedException::class,
    'Name cannot be blank'
);

test('grade cannot be zero or negative', function (int $grade): void {
    $this->school->addStudentToGrade('Fred', $grade);
})->with([0, -1])->throws(
    AssertionFailedException::class,
    'Grade must be greater than or equal to 1'
);
