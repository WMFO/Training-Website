Training Education Management System (TEMS)
===========================================

WMFO - Tufts Freeform Radio  
training@wmfo.org  
written by Nicholas Andre  
For copyrights and licensing, see COPYING  
Version 2.3.0  

A coordination platform to make sure DJs know how to answer phones. A login management platform capable of keeping track of registration, attendance, and checklist functionality. Currently it is very specifically tailored to the WMFO 2 week training process. Modification for another platform would prove difficult, but it could be used as a basis for a more complicated CMS. It includes basic registration, login, password reset through email, and other things.  

TEMS has entered a Long Term Limited Support phase. Only critical bug fixes and minimal content updates will follow.  

TEMS 

Changelog
=========
2/21/13 -- V 2.3.0
All bug fixes and logic fixes implemented from second training session and additional features added. In particular, the logic regarding attendance lockout for add/drop students was corrected to take into account the ability of the admin user to modify attendance. TEMS entering Long Term Minimal Support phase.  

2/9/13 -- V 2.0  
All Features Functional. Includes ability to view quiz results. End of primary development phase. Only bug fixes and minor tweaks to follow.  

9/16/12 -- V 1.50  
Wrapped in CSS to make it look pretty.  

9/12/12 -- V 1.15  
User Modification is now possible from user page in global admin or from individual user pages.  

9/9/12 -- V 1.00  
Added checklist modification capability. User modification still impossible, but deemed unecessary for the mean time given the global delete feature. This is the primary release for the system. Bug fixes may follow.

9/8/12 -- V 0.98  
Added Statistics information, global reset, stronger password hashing based on blowfish. Ready for initial deployment. Still to come are the full CMS features of the Checklist and User Modification (this may not be implemented in favor of simply razing all user accounts at the end of the training cycle.) This release requires setting your pwd column to VARCHAR(60).  

9/6/12 -- V 0.95  
Functionality now includes password reset emailing with typo. 

8/30/12 -- V 0.90  
Production Beta Release. To undergo final testing and initial deployment.  

8/28/12 -- V 0.85  
Added user management and fixed a few bugs.

8/27/12  
First push, version 0.80. 90% of basic functionality added. Administration yet to be completed.
