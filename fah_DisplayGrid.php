$stylevar[htmldoctype]
<html xmlns="http://www.w3.org/1999/xhtml" dir="$stylevar[textdirection]" lang="$stylevar[languagecode]">
<head>
$headinclude

<title>$vboptions[bbtitle] - Folding @ Home</title>

<style type="text/css">
	.TFtable{
		width:100%; 
		border-collapse:collapse; 
	}
	.TFtable td{ 
		padding:7px; border:#4e95f4 1px solid;
	}
	/* provide some minimal visual accomodation for IE8 and below */
	.TFtable tr{
		background: #b8d1f3;
	}
	/*  Define the background color for all the ODD background rows  */
	.TFtable tr:nth-child(odd){ 
		background: #CCD3DD;
	}
	/*  Define the background color for all the EVEN background rows  */
	.TFtable tr:nth-child(even){
		background: #F5F7FA;
	}
</style>

</head>
<body>
$header
$navbar

<if condition="$pagenav">
	<table cellpadding="0" cellspacing="0" border="0" width="100%" style="margin-bottom:3px">
		<tr valign="bottom">
			<td align="$stylevar[right]">$pagenav</td>
		</tr>
	</table>
</if>


<table cellpadding="0" cellspacing="6" border="0" width="100%" align="center">
	<tr>
		<td>
			<table cellpadding="0" cellspacing="0" border="0" class="tborder" width="100%" align="center"> 
			  <tr> 
			    <td> 
			    	<table cellpadding="6" cellspacing="1" border="0" width="100%"> 
			        <tr align="center">      
								<td class="thead">Overclock.net Folding@Home Team Informations</td>
			        </tr>
							<tr>
								<td class="alt1">
									<table cellpadding="0" cellspacing="2" border="0" width="100%" align="center">
										<tr>
											<td width="50%" valign="top">
												<fieldset class="fieldset">
													<legend>Overclock.net Folding@Home Team</legend>
													<table width="100%" border="0" cellspacing="5" cellpadding="0">
														<tr>
														    <td class="smallfont" align="left" valign="top">
																	<a href="overclock-net-folding-home-team/1605-join-overclock-net-s-folding-home.html"><img src="/images/folding/FoldingLogo.png" width="160" height="88" border="0"></a>
																</td>
																<td valign="top">
																	Become a member of the Overclock.net Folding@Home team. For more info on what Folding@Home is and why it's a "good thing" visit <a onclick="alert('Need Link');">Here!</a><br><br>

																	Download the program <a onclick="alert('Need Link');">Here!</a>
																</td>
														</tr>
													</table>
												</fieldset>

								</td>
								<td valign="top">
									<fieldset class="fieldset">
										<legend>Folding Stats</legend>
										<table width="100%" border="0" cellspacing="5" cellpadding="0">
											<tr>
											    <td class="smallfont" align="left">Team Number:</td><td class="smallfont" align="left"><b>37726</b></td>
											</tr>
											<tr>
											    <td class="smallfont" align="left">Name:</td><td class="smallfont" align="left"><b>Overclock.net</b></td>
											</tr>
											<tr>
											    <td class="smallfont" align="left">Team Rank:</td><td class="smallfont" align="left"><b>$team[fteamrank]</b></td>
											</tr>
											<tr>
											    <td class="smallfont" align="left">Score:</td><td class="smallfont" align="left"><b>$formatted_team_points</b></td>
											</tr>
											<tr>
											    <td class="smallfont" align="left">Work Units:</td><td class="smallfont" align="left"><b>$formatted_team_units</b></td>
											</tr>
										</table>
									</fieldset>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td valign="top">
			$memberlist
		</td>
	</tr>
	
	
</table>
	
	<table class="tborder" cellpadding="$stylevar[cellpadding]" cellspacing="$stylevar[cellspacing]" border="0" width="100%" align="center">
<tr>
	<td class="alt1" align="center">

		<form action="fah.display.php" method="get">
		<input type="hidden" name="s" value="$session[sessionhash]" />
		<input type="hidden" name="sortfield" value="$sortfield" />
		<input type="hidden" name="sortorder" value="$sortorder" />
		<div class="fieldset" style="margin:0px">
$vbphrase[per_page]:<input type="text" style="font-size:11px" name="pp" value="$perpage" size="2" />&nbsp; &nbsp;<input type="submit" class="button" value="Show" accesskey="s" />
		</div>
		</form>

	</td>
</tr>
</table>
	
	
	
	
	$footer

</body>
</html>