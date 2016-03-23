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
    
    //--------------------------------------------------------------------------
    //  List Builders
    //--------------------------------------------------------------------------
    
    /**
     * Gets a list of all weekdays.
     */
    public function getDayList()
    {
        $dayList = array(
            'Monday' => array(
                'value' => 'Monday'
            ),
            'Tuesday' => array(
                'value' => 'Tuesday'
            ),
            'Wednesday' => array(
                'value' => 'Wednesday'
            ),
            'Thursday' => array(
                'value' => 'Thursday'
            ),
            'Friday' => array(
                'value' => 'Friday'
            )
        );
        
        return $dayList;
    }
    
    /**
     * Gets a list of a few periods.
     */
    public function getPeriodList()
    {
        $periodList = array(
            '0830' => array(
                'value' => '0830'
            ),
            '0930' => array(
                'value' => '0930'
            ),
            '1030' => array(
                'value' => '1030'
            ),
            '1130' => array(
                'value' => '1130'
            ),
            '1230' => array(
                'value' => '1230'
            ),
            '1330' => array(
                'value' => '1330'
            ),
            '1430' => array(
                'value' => '1430'
            ),
            '1530' => array(
                'value' => '1530'
            ),
            '1630' => array(
                'value' => '1630'
            ),
        );
        
        return $periodList;
    }
    
    //--------------------------------------------------------------------------
    //  Search Methods
    //--------------------------------------------------------------------------
    
    /**
     * Search the days array for a particular timeslot.
     */
    public function searchDays($searchDay, $searchPeriod)
    {
        // Check each dayslot for a match and return if so.
        foreach ($this->days as $record)
        {
            if ($record->day === $searchDay && 
                    $record->period === $searchPeriod)
            {
                return $record;
            }
        }
        
        // If no match, return null.
        return null;
    }
    
    /**
     * Search the periods array for a particular timeslot.
     */
    public function searchPeriods($searchDay, $searchPeriod)
    {
        // Check each periodslot for a match and return if so.
        foreach ($this->periods as $record)
        {
            if ($record->day === $searchDay && 
                    $record->period === $searchPeriod)
            {
                return $record;
            }
        }
        
        // If no match, return null.
        return null;
    }
    
    /**
     * Search the courses array for a particular timeslot.
     */
    public function searchCourses($searchDay, $searchPeriod)
    {
        // Check each dayslot for a match and return if so.
        foreach ($this->courses as $record)
        {
            if ($record->day === $searchDay && 
                    $record->period === $searchPeriod)
            {
                return $record;
            }
        }
        
        // If no match, return null.
        return null;
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
    
    //--------------------------------------------------------------------------
    //  Constructors
    //--------------------------------------------------------------------------
    
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
    
    //--------------------------------------------------------------------------
    //  Utilities
    //--------------------------------------------------------------------------
    
    /**
     * Compares the current Slot object to one provided as a parameter. Returns
     * true if all of the variable values are equal and false otherwise.
     */
    public function equals($otherSlot)
    {
        if(     $this->day === $otherSlot->day &&
                $this->period === $otherSlot->period &&
                $this->course === $otherSlot->course &&
                $this->type === $otherSlot->type &&
                $this->instructor === $otherSlot->instructor &&
                $this->room === $otherSlot->room)
        {
            return true;
        }
        
        return false;
    }
}
