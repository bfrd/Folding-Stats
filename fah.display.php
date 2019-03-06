<?php
/*======================================================================*\
|| #################################################################### ||
|| # v3 Folding [www.overclock.net]					                    ||
|| #################################################################### ||
\*======================================================================*/

// ####################### SET PHP ENVIRONMENT ###########################
error_reporting(E_ALL & ~E_NOTICE);

// #################### DEFINE IMPORTANT CONSTANTS #######################
define('NO_REGISTER_GLOBALS', 1);
define('THIS_SCRIPT', 'fah.display');

// ################### PRE-CACHE TEMPLATES AND DATA ######################
// get special phrase groups
$phrasegroups = array();

// get special data templates from the datastore
$specialtemplates = array();

// pre-cache templates used by specific actions
$actiontemplates = array();

// #######################################################################
// ######################## START MAIN SCRIPT ############################
// #######################################################################

// ######################### MAIN FAH PAGE ############################
	// pre-cache templates used by all actions
	$globaltemplates = array(
		'fah_DisplayGrid',
		'fah_memberlist',
		'fah_memberlist_bit'
	);
	require_once('./global.php');
 
$vbulletin->input->clean_array_gpc('r', array(
   	'perpage' => TYPE_INT,
	'page' => TYPE_INT
));
 
$perpage = $vbulletin->GPC['perpage'];
$page = $vbulletin->GPC['page'];

    $teamid=37726;
    $team=$db->query_first("SELECT * FROM fah_team WHERE teamid='$teamid'");
    
    	$formatted_team_points = number_format($team[fscore], 0, '.', ',');
	$formatted_team_units = number_format($team[fwu], 0, '.', ',');

	if ($perpage == 0 or $perpage > 500)
	{
		$perpage = 500;
	}

	if ($page == 0)
	{
		$pagenumber = 1;
	}
	else
	{
		$pagenumber = $page;
	}

	$limitlower = ($pagenumber - 1) * $perpage + 1;
	$limitupper = ($pagenumber) * $perpage;

    $membercount = $db->query_first("
        SELECT COUNT(*) AS members
        FROM fah_memberstats
    ");
    $total_members = $membercount['members'];

	$numberpages = $total_members / $perpage;
	$numberpages = ceil($numberpages);

 	if (!isset($pagenumber) or ($pagenumber < 1) or ($pagenumber > $numberpages)) $pagenumber = 1;

	$pos = ($pagenumber - 1) * $perpage;

    $members=$db->query_read("SELECT * FROM fah_memberstats ORDER BY lteamrank LIMIT $pos, $perpage");
    $counter = 0;
    while($member=$db->fetch_array($members) AND $counter < $perpage)
    {
        $counter++;
                exec_switch_bg(alt1);

$formatted_fteamrank = number_format($member[fteamrank], 0, '.', ',');
$formatted_frank = number_format($member[frank], 0, '.', ',');
		$formatted_points = number_format($member[fcredit], 0, '.', ',');
		$formatted_units = number_format($member[ftotal], 0, '.', ',');
		$lowerfolder = trim(strtolower($member[name]));
		$lowermember = trim(strtolower($vbulletin->userinfo['field5']));
    $meClass = '';
    
    if($lowermember == $lowerfolder)
    {
    	$meClass = "class='Me'";
    }

            eval('$memberbits .= "' . fetch_template('fah_memberlist_bit') . '";');
    }
    $db->free_result($members);
    $pagenav = construct_page_nav($pagenumber, $perpage, $total_members, "/fah.display.php?$session[sessionurl]");

    eval('$memberlist = "' . fetch_template('fah_memberlist') . '";');
    
    




	//eval('$fahbody = "' . fetch_template('fah_main') . '";');
 
 	$navbits = array();
	$navbits[""] = "Folding@Home";
			
$navbits = construct_navbits($navbits);
eval('$navbar = "' . fetch_template('navbar') . '";');
eval('print_output("' . fetch_template('fah_DisplayGrid') . '");');
?>