<?php

/**
 * Model for a timetable XML document.
 *
 * @author Erick
 */
class Timetable extends CI_Model
{
    protected $xml = null;
    protected $days = array();      // Days timetable facet.    
    protected $periods = array();   // Periods timetable facet.
    protected $courses = array();   // Courses timetable facet.
    
    //--------------------------------------------------------------------------
    //  Drop-down Arrays
    //--------------------------------------------------------------------------
    
    //array for day names
    protected $dayNames = array(Monday=>"Monday", Tuesday=>"Tuesday", 
            Wednesday=>"Wednesday", Thursday=>"Thursday", Friday=>"Friday");
    
    //array for period times
    protected $periodTimes = array(0830=>"8.30am", 0930=>"9.30am", 1030=>"10.30am",
            1130=>"11.30am", 1230=>"12.30pm", 1330=>"1.30pm", 1430=>"2.30pm",
            1530=>"3.30pm", 1630=>"4.30pm");
    
    //--------------------------------------------------------------------------
    //  Constructors
    //--------------------------------------------------------------------------
    
    public function __construct()
    {
        parent::__construct();
        $this->xml = simplexml_load_file('./data/timetable.xml', 
                "SimpleXMLElement", LIBXML_NOENT);
        
        // Build the days array from the days facet.
        foreach ($this->xml->days->day as $day)
        {
            foreach ($day->dayslot as $dayslot)
            {
                $this->days[] = new Slot($dayslot,$day);
            }
        }
        
        // Build the periods array from the periods facet.
        foreach ($this->xml->periods->period as $period)
        {
            foreach ($period->periodslot as $periodslot)
            {
                $this->periods[] = new Slot($periodslot,$period);
            }
        }
        
        // Build the courses array from the courses facet.
        foreach ($this->xml->courses->course as $course)
        {
            foreach ($course->courseslot as $courseslot)
            {
                $this->courses[] = new Slot($courseslot,$course);
            }
        }
        
    }
    
    //--------------------------------------------------------------------------
    //  Accessors
    //--------------------------------------------------------------------------
    
    /**
     * Returns the array of dayslots;
     */
    public function getDays()
    {
        return $this->days;
    }
    
    /**
     * Returns the array of periodslots;
     */
    public function getPeriods()
    {
        return $this->periods;
    }
    
    /**
     * Returns the array of courseslots;
     */
    public function getCourses()
    {
        return $this->courses;
    }
    
    /**
     * Returns the array of dayNames
     */
    public function getDayNames()
    {
        return $this->dayNames;
    }
    
    /**
     * Returns the array of periodTimes
     */
    public function getPeriodTimes()
    {
        return $this->periodTimes;
    }
}

//==============================================================================
//  Slot Classes
//==============================================================================

/**
 * Model for a slot of any type (day, period, or course).
 *
 * @author Erick
 */
class Slot extends CI_Model
{
    public $day;        // Which day of the week?
    public $period;     // Which period of the day?
    public $course;     // Which course number?
    public $type;       // Lec or Lab?
    public $instructor; // Course instructor.
    public $room;       // Classroom.
    
    public function __construct($slot, $container)
    {
        // Set the slot values from the XML elements provided.
        
        // Replace the value for day with the full day name.
        $this->day = (String) 
                (isset($slot['day']) ? $slot['day'] : $container['which']);
        $this->period = (String) 
                (isset($slot['period']) ? $slot['period'] : $container['which']);
        $this->course = (String) 
                (isset($slot['course']) ? $slot['course'] : $container['which']);
        $this->type = (String) $slot->type;
        $this->instructor = (String) $slot->instructor;
        $this->room = (String) $slot->room;
    }
}
