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

    public function tryToTest(AcceptanceTester $I): void
    {
        // Write your tests here. All `public` methods will be executed as tests.
        $I->wantTo('Submit a student name and view their courses');

        $I->amOnPage('/index.php');

        $I->fillField('studentName', 'Julian Peter Gerona');
        $I->click('Submit');

        $I->see('Student Information');
        $I->see('Julian Peter Gerona');
        $I->see('2022153329');
        $I->see('Bachelor of Science in Information Technology');

        $I->see('IT140P');
        $I->see('Application Development and Emerging Technologies');
        $I->see('IT145');
        $I->see('System Integration and Architectures');
    }
}
