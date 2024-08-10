# CRUD Operation Project

## Description

This project demonstrates a simple CRUD (Create, Read, Update, Delete) application built using PHP, CSS, MySQL and postman. It allows users to register, view, update, and delete records in a MySQL database through a web interface.

## Features

- **Registration**: Users can create new records with personal details.
- **View Records**: Users can view a list of all registered records.
- **Update Records**: Users can update existing records.
- **Delete Records**: Users can delete records from the database.
- **API Integration**: The application integrates with an external API to fetch state data.

## Technologies Used

- **PHP**: Server-side scripting language used to handle business logic and database operations.
- **CSS**: Styling language used to design and layout the application.
- **MySQL**: Database management system used to store and manage data.
- **Postman**: Tool for testing API endpoints.

## Installation

### Prerequisites

- **XAMPP/WAMP/MAMP**: Install a local server environment that includes PHP, MySQL, and Apache.
- **Git**: To clone the repository.
-  **Postman**: For testing API endpoints.

### Steps

1. **Clone the Repository**
   Open your terminal or command prompt and run:
   ```bash
   git clone https://github.com/sanju3116/FullStackProject.git
   
2.**Navigate to the Project Directory**
    cd FullStackProject 
    
  **Second Way** download the zip file extract it and copy the extracted file into the xamm>htdocs and past the file.        

3. **Set Up the Database**
    Create a new MySQL database.
    Import the database schema using the provided data base file.

3.**Configure Database Connection**
  Open the connection.php file: This file contains the database connection settings.
  Update the credentials: Replace your_username, your_password, your_database_name and your_port number with your actual database credentials.
  
4.**Start the Local Server**
  Open XAMPP/WAMP/MAMP control panel.
  Start Apache and MySQL services.
  
  5 **Access the Application**
     Open your web browser and go to http://localhost/your-repository/create.php to access the registration page.

## API Integration
The project integrates with an external API to fetch state data. Below are the details for using the API:

API URL
. URL:[link text](https://quickdesign.dmimpact.com/states)
. Authorization: Use the header 
. Authorization: 123456

**How It Works**
Fetching State Data:

The application makes a GET request to the API endpoint to retrieve the list of states.
The API returns a JSON response containing state information.
Usage in the Application:

The fetched state data is used to populate the state dropdown in the registration form.

**Using Postman**
1.Open Postman.
2.Create a New Request:
     .Choose the HTTP method (GET, POST, PUT, DELETE) based on the operation you want to test.
     .Enter the URL for the API endpoint.
     .Set the request body if required (for POST and PUT requests).
     .Set the headers as needed (e.g., Content-Type: application/json).
3.Send the Request and Review the Response.


