# Train_Ticket_Mangement
A simple Train Ticket Mangement System database (DBMS) project based on MySQL

## Acknowledgement
Collaborated with three groupmates: Huancheng Yang & You Ding

## Project Describtion
This DBMS project is a train trip booking and management platform. It enables user to book train trip in advance (2 weeks)
from one city to another. Users can also book tickets for their friends and families. Meanwhile, the system staffs can perform alternations
to user orders and train trips. Here are the list of operations from user and staff:

#### User:
1. Search tickets from a departure location to an arrival location (or find all available train trips leaving the departure station)
2. Search tickets based on a date, and can choose to show trips leaving before the date, after the date and on exact selected date.
3. View all the available train trips and book tickets
4. Choose passenger from history passenger list (where the user already book tickets for them before) or add new passengers
5. Combine multiple tickets with different destination, different passengers and different time to one order.
6. Review the order (delete tickets from shopping cart) before pay.
7. See all history orders and related tickets
8. Make changes to existing order
9. Calculate total money spend on train trip

#### Some other important features:
1. Ticket Price is calculated automatically, no need to set a price for every trip between every two stations
2. Discount and Surcharge is automatically applies based on user’s age and special id as well as passenger’s seat class selection
(premium seats pay more)
3. Departure Date on intermediate train stations are calculated based on trip duration from first train station. No need to record a
departure date for every intermediate train station on every train trip.

#### Staff:
1. Check User Order
2. Assign Passengers Seats
3. List User’s Orders
4. Search For Passengers
5. Add Train Trip
6. Alter Train Trip
7. Remove Train Trip
8. Remove User
9. Add Trip Schedule
10. Alter Trip Schedule
11. Remove Trip Schedule

