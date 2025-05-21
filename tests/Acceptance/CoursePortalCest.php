<?php

declare(strict_types=1);


namespace Tests\Acceptance;

use Tests\Support\AcceptanceTester;

final class CoursePortalCest
{
    public function _before(AcceptanceTester $I): void
    {
        // Code here will be executed before each test.
    }

    public function GetCoursesSuccess(AcceptanceTester $I): void
    {
        $I->wantTo('Submit a student name and view their courses');

        $I->amOnPage('/index.php');
        $I->fillField('studentName', 'Julian Peter Gerona');
        $I->wait(2);
        $I->click('Get courses');

        $I->see('Student Information');
        $I->see('Julian Peter Gerona');
        $I->see('2022153329');
        $I->see('Bachelor of Science in Information Technology');

        $I->see('IT140P');
        $I->see('Application Development and Emerging Technologies');
        $I->see('IT145');
        $I->see('System Integration and Architectures');
        $I->see('CS198L');
        $I->see('Comprehensive Examination Module');
        $I->see('IT190-2P');
        $I->see('Networks and Security (Paired)');
        $I->see('IT190-3P');
        $I->see('Virtualization and Cloud Security (Paired)');
        $I->wait(5);
    }

    public function GetCoursesAnotherSuccess(AcceptanceTester $I): void
    {
        $I->wantTo('Submit a student name in random case and view their courses');

        $I->amOnPage('/index.php');
        $I->fillField('studentName', 'lUiS gerard TiOngCo');
        $I->wait(2);
        $I->click('Get courses');

        $I->see('Student Information');
        $I->see('Luis Gerard Tiongco');
        $I->see('2022152009');
        $I->see('Bachelor of Science in Information Technology');

        $I->see('IT140P');
        $I->see('Application Development and Emerging Technologies');
        $I->see('IT145');
        $I->see('System Integration and Architectures');
        $I->see('CS198L');
        $I->see('Comprehensive Examination Module');
        $I->wait(5);
    }

    public function GetCoursesFailure(AcceptanceTester $I): void
    {
        $I->wantTo('Submit a student name that does not exist');

        $I->amOnPage('/index.php');
        $I->fillField('studentName', 'Belen Ladesma');
        $I->wait(2);
        $I->click('Get courses');

        $I->see('Oops!');
        $I->see('No courses were found for Belen Ladesma');
        $I->wait(5);
    }

    public function GetCoursesNoCourses(AcceptanceTester $I): void
    {
        $I->wantTo('Submit a student name that exists but has no courses');

        $I->amOnPage('/index.php');
        $I->fillField('studentName', 'Christian Kerby Salandanan');
        $I->wait(2);
        $I->click('Get courses');

        $I->see('Student Information');
        $I->see('Christian Kerby Salandanan');
        $I->see('It seems that there are no 3T courses enrolled for this student.');
        $I->wait(5);
    }

    public function GetCoursesNoInput(AcceptanceTester $I): void
    {
        $I->wantTo('Submit a student name that is empty');

        $I->amOnPage('/index.php');
        $I->fillField('studentName', '');
        $I->wait(2);
        $I->click('Get courses');

        $I->dontSee('Student Information');
        $I->dontSee('Courses Taken');
        $I->dontSee('XML Response');
        $I->wait(5);
    }
}
