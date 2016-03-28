<form action ="/welcome/search" method="post">
    <h3>Search for a Timeslot</h3>
    <br/>
    <select name="searchDay">
            {dayList}
            <option value="{value}">{value}</option>
            {/dayList}
    </select>
    <select name="searchPeriod">
            {periodList}
            <option value="{value}">{value}</option>
            {/periodList}
    </select>
    <br/>
    <input name="submit" type="submit" value="Search"/>
</form>
