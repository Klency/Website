<?php
session_start();

			//class pour les jours de la semaine
			//permet de faire plusieur fonction qui depende d'un jour
abstract class DaysOfWeek
{
	const Sunday 	= 0;
	const Monday 	= 1;
	const Tuesday 	= 2;
	const Wednesday = 3;
	const Thursday 	= 4;
	const Friday 	= 5;
	const Saturday 	= 6;

				//TODO:
				//	Faire en sorte que les prints doit different 
	public function print_day($DaysOfWeek)
	{
		switch($DaysOfWeek)
		{
			case 0:
			return "Sunday";
			break;
			case 1:
			return "Monday";
			break;
			case 2:
			return "Tuesday";
			break;
			case 3:
			return "Wednesday";
			break;
			case 4:
			return "Thursday";
			break;
			case 5:
			return "Friday";
			break;
			case 6:
			return "Saturday";
			break;						
		}
	}
	//exemple : $today = DaysOfWeek::Monday;
};


//Objet event qui va représenter un evenement
//application de la loi de demeter
class event
{
	public function __construct($name, $des, $loc, $day, $beg, $end)
	{
		$this->set_name($name);
		$this->set_description($des);
		$this->set_location($loc);
		$this->set_begening($beg);
		$this->set_ending($end);
		$this->set_day($day);
	}

	public function get_name()
	{
		return $this->name;
	}
	public function get_description()
	{
		return $this->description;
	}
	public function get_location()
	{
		return $this->location;
	}
	public function get_day()
	{
		return $this->day;
	}
	public function get_begening()
	{
		return $this->begening;
	}
	public function get_ending()
	{
		return $this->ending;
	}
	public function set_name($name)
	{
		$this->name = $name;
	}
	public function set_description($des)
	{
		$this->name = $des;
	}
	public function set_location($loc)
	{
		$this->name = $loc;
	}
	public function set_begening($beg)
	{
		$this->name = $beg;
	}
	public function set_ending($end)
	{
		$this->name = $end;
	}
	private $name = "";
	private $description = "";
	private $location = "";
	private $day;
	private $begening;
	private $ending;				
};

$_SESSION['events'] = array();

if ((isset($_SESSION['events'])) && (!empty($_SESSION['events'])))
{
				//Si events est setté il faut une boucle pour afficher dans le tableau tout les evenements
				//TODO
}
?>
<!DOCTYPE html>
<html>
<head>
	<link id="style" rel="stylesheet" href="style2.css" style='1'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script src="javascript.js"></script>

</head>
<body>
	<div class="center">
		<div class="inline">
			<h1 id="title">Make your calendar!</h1>
			<p id="change_theme">change theme</p>
		</div>
		<div class="event_array">	
			<div  class='tbl-header'><table cellpadding='0' cellspacing='0' border='0'>
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Location</th>
						<th>Days</th>
						<th>Begening</th>
						<th>Ending</th>
					</tr>
				</thead>
			</table></div>
			<div  class='tbl-content'>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tbody>
						<?php
			//exemple de comment afficher correctement le tableau 
			//TODO:
			//	generer ce tableau par rapport au tableau d'evenement
			//	stocké dans une variable de session!
						echo "
						<tr>
							<td>AAC</td>
							<td>cours de s&eacutecurit&eacute informatique</td>
							<td>$1.38</td>
							<td>Monday</td>
							<td>+2.01</td>
							<td>-0.36%</td>
						</tr>
						<tr>
							<td>AAD</td>
							<td>AUSENCO</td>
							<td>$2.38</td>
							<td>Monday</td>
							<td>-0.01</td>
							<td>-1.36%</td>
						</tr>
						<tr>
							<td>AAX</td>
							<td>ADELAIDE</td>
							<td>$3.22</td>
							<td>Monday</td>
							<td>+0.01</td>
							<td>+1.36%</td>
						</tr>
						<tr>
							<td>XXD</td>
							<td>ADITYA BIRLA</td>
							<td>$1.02</td>
							<td>Monday</td>
							<td>-1.01</td>
							<td>+2.36%</td>
						</tr>
						<tr>
							<td>AAC</td>
							<td>AUSTRALIAN COMPANY </td>
							<td>$1.38</td>
							<td>Monday</td>
							<td>+2.01</td>
							<td>-0.36%</td>
						</tr>
						<tr>
							<td>AAD</td>
							<td>AUSENCO</td>
							<td>$2.38</td>
							<td>Monday</td>
							<td>-0.01</td>
							<td>-1.36%</td>
						</tr>
						<tr>
							<td>AAX</td>
							<td>ADELAIDE</td>
							<td>$3.22</td>
							<td>Monday</td>
							<td>+0.01</td>
							<td>+1.36%</td>
						</tr>
						<tr>
							<td>XXD</td>
							<td>ADITYA BIRLA</td>
							<td>$1.02</td>
							<td>Monday</td>
							<td>-1.01</td>
							<td>+2.36%</td>
						</tr>
						<tr>
							<td>AAC</td>
							<td>AUSTRALIAN COMPANY </td>
							<td>$1.38</td>
							<td>Monday</td>
							<td>+2.01</td>
							<td>-0.36%</td>
						</tr>
						<tr>
							<td>AAD</td>
							<td>AUSENCO</td>
							<td>$2.38</td>
							<td>Monday</td>
							<td>-0.01</td>
							<td>-1.36%</td>
						</tr>
						<tr>
							<td>AAX</td>
							<td>ADELAIDE</td>
							<td>$3.22</td>
							<td>Monday</td>
							<td>+0.01</td>
							<td>+1.36%</td>
						</tr>
						<tr>
							<td>XXD</td>
							<td>ADITYA BIRLA</td>
							<td>$1.02</td>
							<td>Monday</td>
							<td>-1.01</td>
							<td>+2.36%</td>
						</tr>
						";
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="inline_button">
			<button class=addEvent onclick="myfunc()">Add event</button>
			<button class=removeEvent>Edit event</button>
			<button class=removeEvent>Remove event</button>
		</div>
		<div class="event_user_input">	
			<div  class='tbl-header'><table cellpadding='0' cellspacing='0' border='0'>
				<thead>
					<tr>
						<th>Name</th>
						<th>Description</th>
						<th>Location</th>
						<th>Days</th>
						<th>Begening</th>
						<th>Ending</th>
					</tr>
				</thead>
			</table></div>
			<div>
				<table cellpadding='0' cellspacing='0' border='0'>
					<tbody>
						<tr>
							<td><input class='input'></input></td>
							<td><input class='input'></input></td>
							<td><input class='input'></input></td>
							<td></td>
							<td>dropdownmenu</td>
							<td>dropdownmenu</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<form id=calenderSetting>
			<h1 type="one">Generate</h1>
			<input class="number" type="number" id="nbrOfActivities" placeholder="Number of activities" />

			<input type="submit" id="makeCalender" value="Make calender" />
		</form>
	</div>
</body>
</html>
