<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends Application 
{
    public function index()
    {
        // Build subviews.
        $this->data['welcome_days'] = $this->welcome_days();
        $this->data['welcome_periods'] = $this->welcome_periods();
        $this->data['welcome_courses'] = $this->welcome_courses();
        
        // Render.
        $this->data['pagebody'] = 'welcome';
        $this->render();
    }
    
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
}
