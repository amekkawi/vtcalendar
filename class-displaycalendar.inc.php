<?php

class DisplayCalendar {

	var $_startDOW;
	var $_showDOWRow;
	var $_showWeekColumn;
	var $_showMonthName;
	var $_omitTableTags;
	
	function DisplayCalendar() {
		$this->_startDOW = 0;
		$this->_showDOWRow = true;
		$this->_showWeekColumn = true;
		$this->_showMonthName = true;
		$this->_omitTableTags = false;
	}
	
	function showMonth($year, $month, $dowstart, &$handler) {
	
		// Determine the first and last day of the month
		$firstDay = new vtDate($year, $month, 1);
		$lastDay = new vtDate($firstDay->getYear(), $firstDay->getMonth(), $firstDay->getDaysInMonth());
		
		// Determine the first day displayed on the calendar.
		// This may be part of the last or current month.
		$firstDisplayDay =& $firstDay->getWeekStartDate($dowstart);
		
		// Determine the last day displayed on the calendar.
		// This may be part of the current or next month.
		$lastDisplayDay =& $lastDay->getWeekEndDate($dowstart);
		
		$displayDays = $lastDisplayDay->getDayDiff($firstDisplayDay);
		
		
		
		if (!$this->_omitTableTags)
			echo '<table class="CalTable" border="0" cellpadding="2" cellspacing="0">' . "\n";
		
		if ($this->_showMonthName)
			echo '<tr class="MonthTitleRow"><td align="center" colspan="' . ($this->_showWeekColumn ? 8 : 7) . '"><a href="#">' . $firstDay->format("%F") . "</a></td></tr>\n";
	
	}
}
?>