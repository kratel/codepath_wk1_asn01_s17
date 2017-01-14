# Project 1 - Globitek CMS

Time spent: **6** hours spent in total

## User Stories

The following **required** functionality is completed:

1. [x]  Create a Users Table

    * Use the command line to connect to the database "globitek".
    * Define a table "users" with columns for:
        * id, first_name, last_name, email, username, created_at
  

2. [x] Create a Page with an HTML Form
	* In the project "globitek", locate the "public/register.php" page.
	* Add an HTML form

    	* with text inputs: first_name, last_name, email, username
    	* submits to: itself ("public/register.php")
3. [x] Detect when the form is submitted.

    * If "/public/register.php" is loaded directly, it should display the form.
    * If the form was submitted, it should retrieve the form data.

4. [x] Validate form data.

    * Use the file "/private/validation_functions.php" as a library for the validation functions you use.
    * Validate the presence of all form values.
    * Validate that no values are longer than 255 characters.
    * Validate that first_name and last_name have at least 2 characters.
    * Validate that username has at least 8 characters.
    * Validate that email contains a "@".

5. [x] Display form errors if any validations fail.

    * Do not submit the data to the database.
    * Redisplay the form with the submitted values filled in.
    * Report all errors as a list above the form.
    * Test each field to ensure you get the expected errors.
6. [x] Submit successfully-validated form values to the database.

    * Write an SQL statement which will insert a new record into the globitek.users table using the submitted form values.
    * Do not forget to add the current date and time to "created_at".
    * Follow best practices regarding the query result and database connection.
    * Use the command line to connect to the database and check the records.

7. [x] Redirect the user to a confirmation page.

    * Locate the page "public/registration_success.php".
    * Redirect the user to the new page.

8. [x] Sanitize all dynamic output for HTML.


The following advanced user stories are optional:

* [x]  **Bonus 1**: Validate that form values contain only whitelisted characters.

    * first_name, last_name: letters, spaces, symbols: - , . '
    * username: letters, numbers, symbols: _
    * email: letters, numbers, symbols: _ @ .
    * Test each field to ensure you get the expected errors.


* [x]  **Bonus 2**: Validate the uniqueness of the username.



## Video Walkthrough

Here's a walkthrough of implemented user stories:

![EnterUserDemo](http://i.imgur.com/Z6zxDsg.gif "Video Walkthrough")

GIF created with [LiceCap](http://www.cockos.com/licecap/).

## Notes

One of the biggest challenges I experienced on this assignment was keeping track of escaping the quotes in my variables. When I implemented the required user stories everything worked great. After implementing the bonus user stories, I didn't realize right away that I had written everything using single quotes. I caught a few right away, however some were more tricky. The bug that eluded me the most which I did not notice until I uncommented the redirect to the register_success page was that my form would not keep the entire first name and last name if they included a single quote. At first I looked through my form validation which is where I first set the variables. I could not find a cause to this there. It wasn't until I took a 1 hour break that I remembered I use single quotes to echo the variable so the quotes inside the variable were not being escaped. I changed this to double quotes as a fix.

## License

    Copyright [yyyy] [name of copyright owner]

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

        http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.