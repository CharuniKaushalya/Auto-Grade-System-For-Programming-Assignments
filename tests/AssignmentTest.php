<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AssignmentTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testInsertAssignment()
    {
        $this->testLogin2Example();
        $this->visit('/assignment_insert')
        ->type('Integers Come In All Sizes', 'title')
        ->type('details of the assignments', 'editor')
        ->type('29 7 27', 'input')
        ->type('4710194409608608369201743232  ', 'output')
        ->press('Submit');
    }


    /* ... view python devesion assignment code submit test ...*/
    public function testShowAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignment_10')
        ->press('Submit')
        ->seeJson([
                 'created' => true,
             ]);

    }

    /* ... view python devesion assignment submission page ...*/
    public function testSubmissionsAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignment_10')
        ->click('Submissons')
        ->seePageIs('/submission_10');
    }

    /* ... view python devesion assignment disscussion page ...*/
    public function testDiscussionAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignment_10')
        ->click('Discussion')
        ->seePageIs('/discussion_10')
        ->type('comment','test created successfully')
        ->press('Send')
        ->seePageIs('/discussion_10');
    }
    
    /* ... view python devesion assignment leaderboard  page ...*/
    public function testLeaderboardAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignment_10')
        ->click('Leaderboard')
        ->seePageIs('/leaderboard_10');
    }

    /* ... view python devesion assignment leaderboard  page export data as a pdf ...*/
    public function testLeaderboardExpotAssignment(){
        $this->testLogin2Example();
        $this->visit('/leaderboard_10')
        ->click('Export Data')
        ->click('PDF');
    }

    /* ... view python devesion assignment all answers page ...*/
    public function testViewAnswersAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignments')
        ->click('View Answers')
        ->seePageIs('/assignmentView_10');
    }

    /* ... provide feedback python devesion assignment answers  page ...*/
    public function testFeedbacksAssignment(){
        $this->testLogin2Example();
        $this->visit('/assignmentView_10')
        ->click('Add Feedback')
        ->type('new feedback','feedback')
        ->press('Provide Feedback')
        ->seePageIs('/assignmentView_10');
    }
}