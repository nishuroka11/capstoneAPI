API Overview

Flow
1.	Owner adds the notice with animal selection, location description and all 
2.	The notice will be displayed across every walker 
3.	The owner will be displayed the list of all available walkers 
4.	(Chat is not available for this development) 
5.	Owner will choose the walker they desire after looking at the profile of the walker (eg: Walker 2) 
6.	Once the walker is selected, the notice status will be changed to in progress 
7.	Walker and the notice will be linked, and walker will need to click on "Completed", to make it complete 
8.	Owner can give review after it has been marked complete 
9.	The average rating will be changed for the walker

Developer Constraints
•	The owner cannot be a walker 
•	One owner can have only one pet
•	If one walk request is approved, all remaining posts will be canceled

Users
•	ID
•	Name (string)
•	User Type (1 => Admin, 2 => Owner, 3 => Walker)
•	Years of experiences (Integer) [UT3]
•	Average Rating (1 ~ 10) [UT2] 
•	Is Available [Boolean] [UT3]

Animals
•	ID
•	Owner ID (UT2)
•	Name (string)
•	Date of Birth (yyyy-mm-dd)
•	Breed Type (string)
•	Is in walk (true | false)

Notices
•	Owner ID (UT2)
•	Animal ID	
•	Walker ID (UT3)
•	Title (String)
•	Description (Long String)
•	Requested Date Time (yyyy-mm-dd h:i:s)
•	From Address ID
•	Rating (1 ~ 10)
•	Created At (yyyy-mm-dd h:i:s)
Walk Request
•	ID
•	Owner ID (UT2)
•	Walker ID (UT3)
•	Animal ID
•	Notice ID
•	Request Status (Pending,Approve, Reject, Completed)
•	Owner Approved At
•	Owner Rejected At
•	Walker Requested At
•	Walker Rejected At
•	Approved At (yyyy-mm-dd h:i:s)
•	Rejected At (yyyy-mm-dd h:i:s)
•	Completed At (yyyy-mm-dd h:i:s)
Address
•	ID
•	Address Line 1 (String)
•	Address Line 2 (String)
•	City (String)
•	State (String)
•	Country (String) [Default Canada]
Chat (Research on Firebase to integrate)
•	Walk Request ID (Nullable)
•	Owner ID
•	Walker ID
•	Animal ID
•	Message
•	Created At
•	Title 


![image](https://user-images.githubusercontent.com/97565727/161468096-8f528f4d-6bff-417f-9128-d0bddf84f41e.png)
