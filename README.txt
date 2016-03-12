================================================================================
                                XML Basics Lab
================================================================================
ACIT 4850
ACIT 4A

Team Members:
    Doig, Marisa
    Fernandez de Arteaga, Erick

--------------------------------------------------------------------------------
    Work Completed
--------------------------------------------------------------------------------

Doig, Marisa:
    - Courses XML (/data/courses.xml)
    - Periods XML (/data/periods.xml)

Fernandez de Arteaga, Erick:
    - Master XML (/data/timetable.xml)
    - Master DTD (/data/timetable.dtd)
    - Days XML (/data/days.xml)
    - Timetable model (/application/models/Timetable.php)
    - Welcome controller (/application/controllers/welcome.php)
    - _template view (/application/views/_template.php)
    - Welcome view (/application/views/welcome.php)
    - Welcome_days view fragment (/application/views/welcome_days.php)
    - Welcome_periods view fragment (/application/views/welcome_periods.php)
    - Welcome_courses view fragment (/application/views/welcome_courses.php)
    - Main CSS file (/assets/css/main.css)

--------------------------------------------------------------------------------
    For Developers
--------------------------------------------------------------------------------

    ----------------------------------------------------------------------------
        Coding Conventions
    ----------------------------------------------------------------------------
    
    - Allman-style braces
    - Tabs for indentation
    - Snake case for variables and methods (except those relating to view 
        fragments)
    - CodeIgniter conventions for file naming (except those relating to 
        view fragments)
    - {main view name}_{view fragment name} naming for view fragments 
        (e.g., welcome_status.php)
    - Pseudo-variables and methods for creating view fragments take the same 
        name as the view fragment (e.g., {welcome_status}, welcome_status(), 
        etc.)

    ----------------------------------------------------------------------------
        Global Session, State, and Pseudo- Variables to Know
    ----------------------------------------------------------------------------