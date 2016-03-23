<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application 
{
    /**
     * Default method for this controller.
     */
    public function index()
    {
        // Build subviews.
        $this->data['welcome_days'] = $this->welcome_days();
        $this->data['welcome_periods'] = $this->welcome_periods();
        $this->data['welcome_courses'] = $this->welcome_courses();
        
        // Build form.
        $this->data['welcome_search'] = $this->welcome_search();
        $this->data['welcome_results'] = '';
        
        // Render.
        $this->data['pagebody'] = 'welcome';
        $this->render();
    }
    
    /**
     * Method to handle timeslot search form.
     */
    public function search()
    {
        // Build subviews.
        $this->data['welcome_days'] = $this->welcome_days();
        $this->data['welcome_periods'] = $this->welcome_periods();
        $this->data['welcome_courses'] = $this->welcome_courses();
        
        // Build form.
        $this->data['welcome_search'] = $this->welcome_search();

        // Get search parameters.
        $searchDay = $this->input->post('searchDay');
        $searchPeriod = $this->input->post('searchPeriod');
        
        // Get search results.
        $dayResult = 
                $this->timetable->searchDays($searchDay, $searchPeriod);
        $periodResult = 
                $this->timetable->searchPeriods($searchDay, $searchPeriod);
        $courseResult = 
                $this->timetable->searchCourses($searchDay, $searchPeriod);
        
        // If there are any nulls, display no bingo.
        if ($dayResult === null || 
                $periodResult === null || 
                $courseResult === null)
        {
            // Input search values.
            $this->data['bingoDay'] = $searchDay;
            $this->data['bingoPeriod'] = $searchPeriod;
            
            // Values returned by search.
            $this->data['dayResult'] = 
                    ($dayResult === null) ? 'no course' : 
                    $dayResult->course . ' ' . $dayResult->type;
            $this->data['periodResult'] = 
                    ($periodResult === null) ? 'no course' : 
                    $periodResult->course . ' ' . $periodResult->type;
            $this->data['courseResult'] = 
                    ($courseResult === null) ? 'no course' : 
                    $courseResult->course . ' ' . $courseResult->type;
            
            // No bingo.
            $this->data['welcome_results'] = 
                    $this->parser->parse('welcome_nobingo', $this->data, true);
        }
        // If there are no nulls returned...
        else
        {
            // ...and if there is a match, display bingo.
            if (    $dayResult->equals($periodResult) &&
                    $dayResult->equals($courseResult))
            {
                // Result values.
                $this->data['bingoDay'] = $searchDay;
                $this->data['bingoPeriod'] = $searchPeriod;
                $this->data['bingoCourse'] = $dayResult->course;
                $this->data['bingoType'] = $dayResult->type;
            
                // Bingo!
                $this->data['welcome_results'] = 
                        $this->parser->parse('welcome_bingo', $this->data, true);
            }
            // ...and if there is no match, display no bingo.
            else
            {
                // Input search values.
                $this->data['bingoDay'] = $searchDay;
                $this->data['bingoPeriod'] = $searchPeriod;
            
                // Values returned by search.
                $this->data['dayResult'] = 
                        ($dayResult === null) ? 'no course' : 
                        $dayResult->course . ' ' . $dayResult->type;
                $this->data['periodResult'] = 
                        ($periodResult === null) ? 'no course' : 
                        $periodResult->course . ' ' . $periodResult->type;
                $this->data['courseResult'] = 
                        ($courseResult === null) ? 'no course' : 
                        $courseResult->course . ' ' . $courseResult->type;
            
                // No bingo.
                $this->data['welcome_results'] = 
                        $this->parser->parse('welcome_nobingo', $this->data, true);
            } 
        }
        
        // Render.
        $this->data['pagebody'] = 'welcome';
        $this->render();
    }
    
    //--------------------------------------------------------------------------
    //  Subview Builders
    //--------------------------------------------------------------------------
    
    private function welcome_days()
    {
        // Get timetable data organized by day.
        $rows = array();
        foreach ($this->timetable->getDays() as $record)
        {
            $rows[] = (array) $record;
        }
        $this->data['days'] = $rows;
            
        return $this->parser->parse('welcome_days', $this->data, true);
    }
    
    private function welcome_periods()
    {
        // Get timetable data organized by period.
        $rows = array();
        foreach ($this->timetable->getPeriods() as $record)
        {
            $rows[] = (array) $record;
        }
        $this->data['periods'] = $rows;
            
        return $this->parser->parse('welcome_periods', $this->data, true);
    }
    
    private function welcome_courses()
    {
        // Get timetable data organized by course.
        $rows = array();
        foreach ($this->timetable->getCourses() as $record)
        {
            $rows[] = (array) $record;
        }
        $this->data['courses'] = $rows;
            
        return $this->parser->parse('welcome_courses', $this->data, true);
    }
    
    private function welcome_search()
    {
        // Get day list data.
        $dayRows = array();
        foreach ($this->timetable->getDayList() as $record)
        {
            $dayRows[] = (array) $record;
        }
        $this->data['dayList'] = $dayRows;
        
        // Get period list data.
        $periodRows = array();
        foreach ($this->timetable->getPeriodList() as $record)
        {
            $periodRows[] = (array) $record;
        }
        $this->data['periodList'] = $periodRows;
            
        return $this->parser->parse('welcome_search', $this->data, true);
    }
}
