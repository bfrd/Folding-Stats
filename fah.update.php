<?php
error_reporting(7);

echo "Begin Folding Stats Collection <br/>";

// start the page generation timer
$pagestarttime = microtime();
define('TIMESTART', microtime());

define('TEAMID', 37726);
define('FIELD_FOLDINGNAME','field43');
define('FIELD_TEAMRANK','field44');
define('FIELD_CREDITS','field45');
define('FIELD_UNITS','field46');
define('FIELD_AWARD','field47');
define('STORAGEPATH','/sites/overclock.net/www/htdocs/forum/attachments/');

// set the current unix timestamp
define('TIMENOW', time());

// define current directory
if (!defined('CWD'))
{
	define('CWD', (($getcwd = getcwd()) ? $getcwd : '.'));
}

// #############################################################################
// fetch the core includes
require_once(CWD . '/includes/class_core.php');

// initialize the data registry
$vbulletin =& new vB_Registry();

// parse the configuration ini file
$vbulletin->fetch_config();

if (CWD == '.')
{
	// getcwd() failed and so we need to be told the full forum path in config.php
	if (!empty($vbulletin->config['Misc']['forumpath']))
	{
		define('DIR', $vbulletin->config['Misc']['forumpath']);
	}
	else
	{
		trigger_error('<strong>Configuration</strong>: You must insert a value for <strong>forumpath</strong> in config.php', E_USER_ERROR);
	}
}
else
{
	define('DIR', CWD);
}

if (!$vbulletin->debug)
{
	set_error_handler('vb_error_handler');
}

// #############################################################################
// load database class
switch (strtolower($vbulletin->config['Database']['dbtype']))
{
	// load standard MySQL class
	case 'mysql':
	case 'mysql_slave':  //BFRD EDIT
	case '':
	{
		if ($vbulletin->debug AND ($vbulletin->input->clean_gpc('r', 'explain', TYPE_UINT) OR (defined('POST_EXPLAIN') AND !empty($_POST))))
		{
			// load 'explain' database class
			require_once(DIR . '/includes/class_database_explain.php');
			$db =& new vB_Database_Explain($vbulletin);
		}
		else
		{
			$db =& new vB_Database($vbulletin);
		}
		break;
	}

	// load MySQLi class
	case 'mysqli':
	{
		if ($vbulletin->debug AND ($vbulletin->input->clean_gpc('r', 'explain', TYPE_UINT) OR (defined('POST_EXPLAIN') AND !empty($_POST))))
		{
			// load 'explain' database class
			require_once(DIR . '/includes/class_database_explain.php');
			$db =& new vB_Database_MySQLi_Explain($vbulletin);
		}
		else
		{
			$db =& new vB_Database_MySQLi($vbulletin);
		}
		break;
	}

	// load extended, non MySQL class
	default:
	{
	// this is not implemented fully yet
	//	$db = 'vB_Database_' . $vbulletin->config['Database']['dbtype'];
	//	$db =& new $db($vbulletin);
		die('Fatal error: Database class not found --' . $vbulletin->config['Database']['dbtype']);
	}
}


// get core functions
if (!empty($db->explain))
{
	$db->timer_start('Including Functions.php');
	require_once(DIR . '/includes/functions.php');
	$db->timer_stop(false);
}
else
{
	require_once(DIR . '/includes/functions.php');
}

// make database connection
$db->connect(
	$vbulletin->config['Database']['dbname'],
	$vbulletin->config['MasterServer']['servername'],
	$vbulletin->config['MasterServer']['port'],
	$vbulletin->config['MasterServer']['username'],
	$vbulletin->config['MasterServer']['password'],
	$vbulletin->config['MasterServer']['usepconnect'],
	$vbulletin->config['SlaveServer']['servername'],
	$vbulletin->config['SlaveServer']['port'],
	$vbulletin->config['SlaveServer']['username'],
	$vbulletin->config['SlaveServer']['password'],
	$vbulletin->config['SlaveServer']['usepconnect'],
	$vbulletin->config['Mysqli']['ini_file'],
	$vbulletin->config['Mysqli']['charset']
);

// make $db a member of $vbulletin
$vbulletin->db =& $db;

// #############################################################################
// fetch options and other data from the datastore
if (!empty($db->explain))
{
	$db->timer_start('Datastore Setup');
}

$datastore_class = (!empty($vbulletin->config['Datastore']['class'])) ? $vbulletin->config['Datastore']['class'] : 'vB_Datastore';

if ($datastore_class != 'vB_Datastore')
{
	require_once(DIR . '/includes/class_datastore.php');
}
$vbulletin->datastore =& new $datastore_class($vbulletin, $db);
$vbulletin->datastore->fetch($specialtemplates);

if ($vbulletin->bf_ugp === null)
{
	echo '<div>vBulletin datastore error caused by one or more of the following:
		<ol>
			' . (function_exists('mmcache_get') ? '<li>Turck MMCache has been detected on your server, first try disabling Turck MMCache or replacing it with eAccelerator</li>' : '') . '
			<li>You may have uploaded vBulletin 3.5 files without also running the vBulletin 3.5 upgrade script. If you have not run the upgrade script, do so now.</li>
			<li>The datastore cache may have been corrupted. Run <em>Rebuild Bitfields</em> from <em>tools.php</em>, which you can upload from the <em>do_not_upload</em> folder of the vBulletin package.</li>
		</ol>
	</div>';

	trigger_error('vBulletin datastore cache incomplete or corrupt', E_USER_ERROR);
}

if (!empty($db->explain))
{
	$db->timer_stop(false);
}

    #################################

    $teamid=37726;
    $team_q = "SELECT * FROM fah_team WHERE teamid='" . TEAMID . "'";
    echo $team_q . "<br/>";
    $team=$db->query_first($team_q);
    
   	echo '<pre>'; print_r($team); echo '</pre>';
    
    
    if(!$team[teamid])
	{
        $lfiledate_check="0000-00-00";
        $lfiledate_year="9999";
        $lfiledate_month="99";
    }
	else
	{
        $lfiledate=explode(" ",$team[lfiledate]);
        $lfile_date=explode("-",$lfiledate[0]);
        $lfiledate_check="$lfile_date[0]-$lfile_date[1]-$lfile_date[2]";
        $lfiledate_year="$lfile_date[0]";
        $lfiledate_month="$lfile_date[1]";
    }
    
    $savefile = true;
    $file_path = "https://apps.foldingathome.org/teamstats/team" . TEAMID . ".txt";
    
    if($_GET["a"])
    {
    	$file_path = "attachments/" . $_GET["a"];
    	$savefile = false;
    }
    
   echo 'Stats Path:' . $file_path . "<br/>";
    if(!$file_lines = @file($file_path))
	{
       exit;
    }
    
    
    
	$db->query_write("DELETE FROM fah_memberstats_incoming");
	echo 'Incoming table cleared.<br/>';
	
    $line_counter=0;
    $member_counter=0;
	
	$arMonthName = array("Jan" => "01", "Feb" => "02", "Mar" => "03", "Apr" => "04", "May" => "05", "Jun" => "06", "Jul" => "07", "Aug" => "08", "Sep" => "09", "Oct" => "10", "Nov" => "11", "Dec" => "12");
	
 $lpath = STORAGEPATH . 'stats.txt';
 
 if($savefile) $hwnd = fopen($lpath, "w+");
 
    foreach($file_lines as $lines)
	{
        $line_counter++;
        $lines=trim(preg_replace('#\s+#si', ' ', $lines));
        $data=explode(" ",$lines);
				if($savefile) fwrite($hwnd, $lines . "\n");

        if($line_counter == 3)
		{
			$data[1] = $arMonthName[$data[1]];
				$filedate_file ="$data[5]-$data[1]-$data[2]";
            $filedate ="$data[5]-$data[1]-$data[2] $data[3]";
            $filedate_check="$data[5]-$data[1]-$data[2]";
            $filedate_year="$data[5]";
            $filedate_month="$data[1]";

            if($filedate_check <= $lfiledate_check)
			{
                echo 'Date check Failed<br/>';
                exit;
            }
            
            $do_archive = 0;
            if($filedate_year > $lfiledate_year)
			{
                $filedate_month = 12;
                $do_archive = 1;
                $archivedate = "$lfiledate_year-12-31";
                $sigyear= "$lfiledate_year";
            }
			elseif($filedate_month > $lfiledate_month)
			{
                $filedate_month = ($filedate_month - 1);
                
                $do_archive = 1;
				switch($filedate_month)
				{
					case 2:
						$archive_day=28; 
						break;
					
					case 1:
					case 5:
					case 7:
					case 8:
					case 10:
						$archive_day=31;
						break;
					
					case 4:
					case 6:
					case 9:
					case 11:
						$archive_day=30;
						break;
				}
			
                if($filedate_month < 10)
				{
                    $archive_month = "0$filedate_month";
                }
				else
				{
                    $archive_month = $filedate_month;
                }
                $archivedate = "$filedate_year-$archive_month-$archive_day";
                $sigyear= "$filedate_year";
            }
            $filedate_month = ($filedate_month*1);
        }
        
        if($line_counter == 5)
		{
            $teamname=$data[1];
            $score=$data[2];
            $wu=$data[3];
        }
        
        if($line_counter == 6)
		{
            $teamrank=$data[2];
        }
        
        if($line_counter > 8)
		{
			$member_counter++;
			$ins_q = "INSERT INTO fah_memberstats_incoming (frank,fteamrank,name,fcredit,ftotal,fupdate,ffiledate,lrank,lteamrank,lcredit,ltotal,lupdate,lfiledate) VALUES ('$data[0]','$data[1]','" . addslashes($data[2]) . "','$data[3]','$data[4]','" . time() . "','$filedate','$data[0]','$data[1]','$data[3]','$data[4]','" . time() . "','$filedate')";
			//echo $ins_q . "<br/>";
			$db->query_write($ins_q);
		}
    }

 if($savefile) fclose($hwnd);
 $lpath2 = STORAGEPATH . "stats$filedate_file.txt";
if($savefile) rename($lpath, $lpath2);

	echo "$member_counter members inserted.<br/>";	
		
	//Merge Duplicates
	$dupeFolders=$db->query_read("SELECT NAME FROM fah_memberstats_incoming GROUP BY NAME HAVING COUNT(NAME) > 1");
	$dupeKey = mt_rand();
	$numDupes = 0;
	if($db->num_rows($dupeFolders))
	{
		$folder_counter=0;
		while($dupeFolder=$db->fetch_array($dupeFolders))
		{
			$numDupes++;
			$newDupeFolder = $dupeKey . "_" . addslashes($dupeFolder[NAME]) . "</br>";
			echo " Duplicate: " . addslashes($dupeFolder[NAME]) . " ==> " . $newDupeFolder;
			$db->query_write("INSERT INTO fah_memberstats_incoming (frank,fteamrank,name,fcredit,ftotal,fupdate,ffiledate,lrank,lteamrank,lcredit,ltotal,lupdate,lfiledate) SELECT frank,fteamrank, '" . $newDupeFolder . "', SUM(fcredit), SUM(ftotal), fupdate, ffiledate, lrank, lteamrank, SUM(lcredit), SUM(ltotal), lupdate, lfiledate FROM fah_memberstats_incoming WHERE NAME = '" . addslashes($dupeFolder[NAME]) . "'");
			$db->query_write("DELETE FROM fah_memberstats_incoming WHERE name = '" . addslashes($dupeFolder[NAME]) . "'");
			$db->query_write("UPDATE fah_memberstats_incoming SET name = '" . addslashes($dupeFolder[NAME]) . "' WHERE name = '" . $newDupeFolder . "'");
		}
	}
	echo "$numDupes Duplicate Names merged.<br/>";
	
	//Insert New People           
	$newFoldersInsert_q = "INSERT INTO fah_memberstats (frank,fteamrank,NAME,fcredit,ftotal,fupdate,ffiledate,lrank,lteamrank,lcredit,ltotal,lupdate,lfiledate) SELECT frank,fteamrank, NAME, fcredit, ftotal, fupdate, ffiledate,lrank,lteamrank,lcredit,ltotal,lupdate,lfiledate FROM fah_memberstats_incoming WHERE NAME NOT IN (SELECT NAME FROM fah_memberstats)";
	echo $newFoldersInsert_q . "<br/>"; 
	$newFolders=$db->query_read($newFoldersInsert_q);

	echo " New Folders added.<br/>";
	
	//Push Data over to production table
	$strPushCommand = "UPDATE fah_memberstats destination 
						INNER JOIN fah_memberstats_incoming source ON destination.name = source.name 
						SET 
						destination.lupdate = source.lupdate,
						destination.lfiledate = source.lfiledate,
						destination.lrank = source.lrank,
						destination.lteamrank = source.lteamrank,
						destination.lcredit = source.lcredit,
						destination.ltotal = source.ltotal,
						destination.CurrentDayCredit = (source.lcredit - destination.lcredit) + 0,
						destination.CurrentDayTotal = (source.ltotal - destination.ltotal) + 0";
	$db->query_write($strPushCommand);

	//Re-Arrange Data
	$arMonthLongName = array(1 => "January", 2 => "February", 3 => "March", 4 => "April", 5 => "May", 6 => "June", 7 => "July", 8 => "August", 9 => "September", 10 => "October", 11 => "November", 12 => "December");
	$arMonthSortColumn = array(1 => "cmonth1", 2 => "cmonth2", 3 => "cmonth3", 4 => "cmonth4", 5 => "cmonth5", 6 => "cmonth6", 7 => "cmonth7", 8 => "cmonth8", 9 => "cmonth9", 10 => "cmonth10", 11 => "cmonth11", 12 => "cmonth12");

	$cmdRearrange = "UPDATE fah_memberstats SET tmonth$filedate_month = tmonth$filedate_month + CurrentDayTotal + 0, cmonth$filedate_month = cmonth$filedate_month + CurrentDayCredit + 0, CurrentMonthCredit = cmonth$filedate_month + CurrentDayCredit + 0, CurrentMonthTotal = tmonth$filedate_month + CurrentDayTotal + 0";
	echo $cmdRearrange . "<br/>";
	$db->query_write($cmdRearrange);
	$orderbystr = $arMonthSortColumn[$filedate_month];
	$sigmonth = $arMonthLongName[$filedate_month];



    if($filedate AND $member_counter)
	{
		
		$xref_q = "INSERT INTO fah_userXref (userid, foldingname)SELECT destination.`userid`,destination." . FIELD_FOLDINGNAME . " FROM `userfield` destination INNER JOIN fah_memberstats source ON destination." . FIELD_FOLDINGNAME . " = source.name  WHERE destination." . FIELD_FOLDINGNAME . " <> ''";
		echo $xref_q . "<br/>";
		$db->query_write($xref_q);
		
		//Update Team Ranks based on current numbers
		$sort_q = "UPDATE fah_memberstats destination, (SELECT @rownum:=@rownum+1 rank, source.name FROM fah_memberstats source, (SELECT @rownum:=0) internal ORDER BY lcredit DESC LIMIT 10000) virtual SET destination.lteamrank = virtual.rank WHERE destination.name = virtual.name";
		echo $sort_q . "<br/>";
		$db->query_write($sort_q);
		
		//Push that data to the profile tables
		$updateProfile_q = "UPDATE userfield destination INNER JOIN fah_userXref xref ON xref.userid = destination.userid INNER JOIN fah_memberstats source ON xref.foldingname = source.name SET destination." . FIELD_TEAMRANK . " = source.lteamrank, destination." . FIELD_CREDITS . " = source.lcredit, destination." . FIELD_UNITS . " = source.ltotal";
		echo $updateProfile_q . "<br/>";
				$db->query_write($updateProfile_q);
		
        if(!$team[teamid])
		{
            $insertTeam_q = "INSERT INTO fah_team (teamid,fteamrank,teamname,fscore,fwu,fupdate,ffiledate,lteamrank,lscore,lwu,lupdate,lfiledate) VALUES ('" . TEAMID . "','$teamrank','" . addslashes($teamname) . "','$score','$wu','" . time() . "','$filedate','$teamrank','$score','$wu','" . time() . "','$filedate')";
            echo $insertTeam_q . "<br/>";
            $db->query_write($insertTeam_q);
        }
		else
		{
            $updateTeam_q = "UPDATE fah_team SET lteamrank='$teamrank',lscore='$score',lwu='$wu',lupdate='" . time() . "',lfiledate='$filedate' WHERE teamid='$team[teamid]'";
            echo $updateTeam_q . "<br/>";
            $db->query_write($updateTeam_q);
        }
        
		if($do_archive)
		{
			$numName = array(1 => "1st", 2 => "2nd", 3 => "3rd");
				$resetAward_q = "UPDATE userfield SET " . FIELD_AWARD . "=''";
				echo $resetAward_q . "<br/>";
            $db->query_write($resetAward_q);
            $folders=$db->query_read("SELECT * FROM fah_memberstats WHERE name!='overclock.net' ORDER BY $orderbystr DESC LIMIT 3");
            if($db->num_rows($folders))
			{
                $folder_counter=0;
                while($folder=$db->fetch_array($folders))
				{
                    $folder_counter++;
                    switch($folder_counter)
					{
						case 1:
						case 2:
						case 3:
                        	$specialsig="$numName[$folder_counter] Place Folder - $sigmonth $sigyear";
							break;
						
						default:
							$specialsig="";
							break;
					}
									$updateAward_q = "UPDATE userfield SET " . FIELD_AWARD . "='$specialsig' WHERE field43='" . addslashes($folder[name]) . "'";
									echo $updateAward_q . "<br/>";
                    $db->query_write($updateAward_q);
                }
                $db->free_result($folders);
            }
            
            
            
            $nextMo = ($filedate_month + 1) % 12;
            $setNextMo_q = "UPDATE fah_memberstats SET cmonth$nextMo='0', tmonth$nextMo='0'";
            echo $setNextMo_q  . "<br/>";

            $db->query_write($setNextMo_q );
        }
    }
    
?>