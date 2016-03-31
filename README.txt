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
    - Master Schema (/data/timetable.xsd)
    - Days XML Stylesheet (/data/timetableDays.xls)

Fernandez de Arteaga, Erick:
    - Master XML (/data/timetable.xml)
    - Master DTD (/data/timetable.dtd)
    - Master Schema (/data/timetable.xsd)
    - Days XML (/data/days.xml)
    - Timetable model (/application/models/Timetable.php)
    - Welcome controller (/application/controllers/welcome.php)
    - _template view (/application/views/_template.php)
    - welcome view (/application/views/welcome.php)
    - welcome_days view fragment (/application/views/welcome_days.php)
    - welcome_periods view fragment (/application/views/welcome_periods.php)
    - welcome_courses view fragment (/application/views/welcome_courses.php)
    - welcome_search view fragment (/applications/views/welcome_search.php)
    - welcome_bingo view fragment (/applications/views/welcome_bingo.php)
    - welcome_nobingo view fragment (/applications/views/welcome_nobingo.php)
    - welcome_xmlvalid view fragment (/applications/views/welcome_xmlvalid.php)
    - Main CSS file (/assets/css/main.css)

--------------------------------------------------------------------------------
    For Developers
--------------------------------------------------------------------------------

    ----------------------------------------------------------------------------
        Coding Conventions
    ----------------------------------------------------------------------------
    
    - Allman-style braces
    - Tabs for indentation
    - lowerCamelCase for variables and methods (except those relating to view 
        fragments)
    - CodeIgniter conventions for file naming (except those relating to 
        view fragments)
    - {main view name}_{view fragment name} (snake_case) naming for view 
        fragments (e.g., welcome_status.php)
    - Pseudo-variables and methods for creating view fragments take the same 
        name as the view fragment (e.g., {welcome_status}, welcome_status(), 
        etc.)

    ----------------------------------------------------------------------------
        Global Session, State, and Pseudo- Variables to Know
    ----------------------------------------------------------------------------