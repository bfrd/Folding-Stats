# Folding Stats

The files in this repository are designed to import daily Folding @ Home stats into the vBulletin (v3.8) software package.  It contains the files neccessary to create the mysql tables that store the data.

vBulletin Setup:

Custom User Profile Field

	Custom profile fields must be created in order to save the results  please create the following fields:
	
		fah_username, fah_teamrank, fah_score, fah_units, and fah_award
		
		All fields should be marked non-editable and hidden.  It is important to note the id of the fields
		
SQL

	Several tables must be created in the database.  Execute the tables.sql file to generate the required
	tables.
	

	
Pre-Installation Requirements:

	Prior to the installation of the scripts some of the constant variables need to be adjusted.  Open the
	fah.update.php and modify the CONST variables near the top of the page with the id values from the user
	profile fields created earlier.  If your forum uses table prefixes those may need to be adjusted as well.



Installation:
	
	Templates:
	
		Please create the following templates:
		
			#Name												#Source
			fah_DisplayGrid 						fah_DisplayGrid.php
			fah_memberlist 							fah_memberlist.php
			fah_memberlist_bit 					fah_memberlist_bit.php
	
	
	Update and Display Code:
	
		Copy the fah.update.php and fah.display.php to the forum's root directory.
		
	Scheduled Task:
	
		Create a scheduled task to run once at 1:00 AM.  Point this task to the fah.update.php page.  
		
		** This file does not log any scheduled task information.