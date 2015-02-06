<?php
/*
Usage:
<?php
include 'ssCalendar.class.php';

$Time = time();

# If Month and Year are Received by a link, assign to Month and Year
# Else Assign current Month and Year to Month and Year
if( $_GET['m'] != '' ){ $Month = $_GET['m']; }else{ $Month = date( 'n', $Time ); }
if( $_GET['y'] != '' ){ $Year = $_GET['y']; }else{ $Year = date( 'Y', $Time ); }

# Without Year/Month Navigation - Default
# With Default Three Letter Weekday
$ssCal = new ssCalendar( $Month, $Year );
$ssCal->printCalendar();

# With Year/Month Noavigation
# With Default Three Letter Weekday
$ssCal->ssCalendar( $Month, $Year, $Nav = 1 );
$ssCal->printCalendar();

# With Year/Month Noavigation
# With Two Letter Weekday
$ssCal->ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 2 );
$ssCal->printCalendar();

# With Year/Month Noavigation
# With One Letter Weekday
$ssCal->ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 1 );
$ssCal->printCalendar();

# With Year/Month Noavigation
# With One Letter Weekday
# With each day linked with the corresponding date appended
$ssCal->ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 2, $DayLinks = 1 );
$ssCal->printCalendar();

# With Year/Month Navigation
# With One Letter Weekday
# With selected days linked with the corresponding date appended
$DayLinks = array( 2=>'test.php', 25=>'test2.php' );
$ssCal->ssCalendar( $Month, $Year, $Nav = 1, $WeekDayLen = 2, $DayLinks );
$ssCal->printCalendar();

?>
*/

class ssCalendar
{
  # class constructor
  # innitialize varaibles
  # $Nav = 0 off
  # $Nav = 1 on
  function ssCalendar( $Month, $Year, $Nav = 0, $WeekDayLen = 3, $DayLinks = 0, $StylePrefix = 'Sm', $CalItemsArray = array() )
  { 
    $this->CalItemsArray = $CalItemsArray;
    $this->Nav = $Nav;
	$this->WeekDayLen = $WeekDayLen;
	$this->DayLinks = $DayLinks;
	$this->Day = date( 'j', time() );
	$this->Month = $Month;
	$this->Year = $Year;
	$this->FirstMonthDay = mktime( 0, 0, 0, $Month, 1, $Year );
	$this->MonthName = date( 'F', $this->FirstMonthDay );	
	$this->FirstWeekDay = date( 'w', $this->FirstMonthDay );
	$this->DaysInMonth = date('t', mktime(0, 0, 0, $this->Month, 1, $this->Year) );
	$this->StylePrefix = $StylePrefix;
	
	//$this->printCalendar();
	
  }  
  
  function getSelectedDate()
  {
    return $this->Month.'-'.$this->Month.'-'.$this->Year;
  }
  
  function weekHeaders()
  { 
    $t = '';
    for( $i = 0; $i < 7; $i++ )
	{
	  $h = date( "D", mktime( 0, 0, 0, $this->Month, ( ( 1 - $this->FirstWeekDay )+$i ), $this->Year ) )."\n";
	  
	  # make sure the substring is between 1 and 3
	  # 1 = S M T W T F S
	  # 2 = Su Mo Tu We Th Fr Sa
	  # 3 = Sun	Mon	Tue	Wed	Thu	Fri	Sat
	  
	  if( $this->WeekDayLen >=1 && $this->WeekDayLen <= 3 )
	  { $t .= '    <td id="'.$this->StylePrefix.'WeekDayHeader">'.substr( $h, 0, $this->WeekDayLen ).'</td>'."\n"; }
	  else
	  { $t .= '    <td id="'.$this->StylePrefix.'WeekDayHeader">'.$h.'</td>'; }
	}
	
	return $t;
  }
  
  function prevYear()
  {
    $prevYear = date( 'Y', mktime( 0, 0, 0, $this->Month, $this->Day, $this->Year-1 ) );
	$prevYearMonth = date( 'n', mktime( 0, 0, 0, $this->Month, $this->Day, $this->Year-1 ) );
	return '<a id="'.$this->StylePrefix.'CalendarNav" href="?m='.$prevYearMonth.'&y='.$prevYear.'">&laquo;</a>';
  }
  
  function nextYear()
  {
    $nextYear = date( 'Y', mktime( 0, 0, 0, $this->Month, $this->Day, $this->Year+1 ) );
	$nextYearMonth = date( 'n', mktime( 0, 0, 0, $this->Month, $this->Day, $this->Year+1 ) );
	return '<a id="'.$this->StylePrefix.'CalendarNav" href="?m='.$nextYearMonth.'&y='.$nextYear.'">&raquo;</a>';
  }
  
  function prevMonth()
  {
    $prevMonth = date( 'n', mktime( 0, 0, 0, $this->Month-1, 1, $this->Year ) );
	$prevMonthYear = date( 'Y', mktime( 0, 0, 0, $this->Month-1, 1, $this->Year ) );
	
	$StrVal = $prevMonthYear.'-'.$prevMonth;
	 $script_link = 'onclick="showContent(\''.$StrVal.'\', \'hours-calendar.php\', \'txtCal\')';
     return '<span class="switch-month" id="previous-month" '.$script_link.'">&laquo;</span>';
	
	//return '<a id="'.$this->StylePrefix.'CalendarNav" href="?m='.$prevMonth.'&y='.$prevMonthYear.'">&laquo;</a>';
  }
  
  function nextMonth()
  {
	
     $nextMonth = date( 'n', mktime( 0, 0, 0, $this->Month+1, 1, $this->Year ) );
	 $nextMonthYear = date( 'Y', mktime( 0, 0, 0, $this->Month+1, 1, $this->Year ) );
	 
	 $StrVal = $nextMonthYear.'-'.$nextMonth;
	 $script_link = 'onclick="showContent(\''.$StrVal.'\', \'hours-calendar.php\', \'txtCal\')';
	
	
	
     return  '<span class="switch-month" id="next-month" '.$script_link.'" >&raquo;</span>';
	//return '<a id="'.$this->StylePrefix.'CalendarNav" href="?m='.$nextYearMonth.'&y='.$nextYear.'">&raquo;</a>';
	 
	 
	 //return '<a id="'.$this->StylePrefix.'CalendarNav" href="?m='.$nextMonth.'&y='.$nextMonthYear.'">&raquo;</a>';
  }
  
  function currentDay( $day_num )
  {
    if( $day_num == date( 'j', time() ) && $this->Year == date( 'Y', time() ) && $this->Month == date( 'n', time() ) )
	{ return $this->StylePrefix.'CurrentDayCell'; }
	else
	{ return $this->StylePrefix.'ActiveCell'; }
  }
    
  # construct the calendar table and print it	
  function printCalendar()
  {
    # Counts the days in the week, up to 7
    $day_count = 1;
	
	# set the first day of the month to 1
    $day_num = 1;
	
	$CalTable = '';
	$CalTable .= '<table border="0" cellpadding="0" cellspacing="0" id="'.$this->StylePrefix.'CalendarTable" class="item_listing monthly_calendar">'."\n";
    
	# detrmine if the nav is on or off
	# $nav = 0 // off
    # $nav = 1 // on
	if( $this->Nav == 1 )
	{ 
	  $CalTable .= '  <tr id="'.$this->StylePrefix.'CalRow">'."\n"
	            //.'    <th>'.$this->prevMonth().'</th>'."\n"
				//.'    <th>'.$this->prevYear().'&nbsp;&nbsp;'.$this->prevMonth().'</th>'."\n"
	              .'    <th colspan="7" id="'.$this->StylePrefix.'CalendarTitle">'.$this->prevMonth().'&nbsp;&nbsp;&nbsp;'.$this->MonthName.'&nbsp;'.$this->Year.'&nbsp;&nbsp;&nbsp;'.$this->nextMonth().'</th>'."\n"
			    //.'    <th>'.$this->nextMonth().'</th>'."\n"
				//.'    <th>'.$this->nextMonth().'&nbsp;&nbsp;'.$this->nextYear().'</th>'."\n"
				  .'  </tr>'."\n";
    }
	elseif( $this->Nav == 0 )
	{
	  $CalTable .= '    <th colspan="7" id="'.$this->StylePrefix.'CalendarTitle">'.$this->MonthName.'&nbsp;'.$this->Year.'</th>'."\n"; 
	}
    
	$CalTable .= '  <tr id="'.$this->StylePrefix.'CalRow">'."\n".$this->weekHeaders().'  </tr>'."\n";
	
    # determine which cells do not have a day number 
	$blank = $this->FirstWeekDay;
	while( $blank > 0 ) 
    { 
      $CalTable .=  '    <td valign="top" id="'.$this->StylePrefix.'NonActiveCell"><div >&nbsp;</div></td>'."\n"; 
      $blank = $blank-1; 
      $day_count++;
    } 

    # count days until we've done all of them in the month
    while( $day_num <= $this->DaysInMonth ) 
    { 
	  $LinkVars = '?m='.$this->Month.'&d='.$day_num.'&y='.$this->Year;
	  $StrVal = $this->Year.'-'.$this->Month.'-'.$day_num;
	  $CellClass = $this->currentDay( $day_num );
	  if( isset( $this->CalItemsArray[$day_num] ) != '' ){
		  $CalItems = $this->CalItemsArray[$day_num];
	  }else{
		  $CalItems = '';
	  }
	  
	  
      # determine linkage of the days
	  if( $this->DayLinks == 0 ) # no links
	  { $CalTable .= '    <td valign="top" id="'.$CellClass.'"><div id="DayNumber">'.$day_num.'</div>'.$CalItems.'</td>'."\n"; }
	  elseif( $this->DayLinks == 1 ) # all links
	  { $CalTable .= '    <td valign="top" id="'.$CellClass.'"><div id="DayNumber"><a onclick="showContent(\''.$StrVal.'\', \'get_hours.php\', \'txtHint\')" href="javascript:void()">'.$day_num.'</a></div>'.$CalItems.'</td>'."\n"; }
	  elseif( is_array( $this->DayLinks ) ) #spacific links
	  { 
	    if( isset( $this->DayLinks[$day_num] ) )
		{ $CalTable .= '    <td valign="top" id="'.$CellClass.'"><div id="DayNumber"><a onclick="showContent(\''.$StrVal.'\', \'get_hours.php\', \'txtHint\')" href="javascript:void()">'.$day_num.'</a></div>'.$CalItems.'</td>'."\n"; }
		else
		{ $CalTable .= '    <td valign="top" id="'.$CellClass.'"><div id="DayNumber">'.$day_num.'</div>'.$CalItems.'</td>'."\n"; }		
	  }
	  else # set to default
	  { $CalTable .= '    <td valign="top" id="'.$CellClass.'"><div id="DayNumber">'.$day_num.'</div>'.$CalItems.'</td>'."\n"; }
	  	  
	  $day_num++; 
      $day_count++;

      # Make sure we start a new row every week
      if( $day_count > 7 )
      {
        $CalTable .= '  </tr>'."\n";
		$CalTable .= '  <tr id="'.$this->StylePrefix.'CalRow">'."\n";
        $day_count = 1;
      }
    }

    # finish the table with blanks if needed
    while( $day_count > 1 && $day_count <=7 ) 
    { 
      $CalTable .=  '    <td id="'.$this->StylePrefix.'NonActiveCell">&nbsp;</td>'."\n"; 
      $day_count++;
    }

    $CalTable .= '  </tr>'."\n";
    $CalTable .= '</table>'."\n";
		
	return $CalTable;    
  }
  
}

?>