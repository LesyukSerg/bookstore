##### **1.** You are tasked with creating a feature-rich web application for managing a list of books.
The emphasis is on developing a robust back-end system, implementing advanced
functionality, maintaining high security standards.

##### **2.** Database: Create a MySQL database named bookstore with two tables:

      2.1. `books` table with columns:
      * * id (Auto-incrementing primary key);
      * title (VARCHAR);
      * published_year (INT);
      * genre_id (INT, foreign key);

      2.2. authors table with columns:
      * id (Auto-incrementing primary key);
      * 2.2.2. name (VARCHAR);
   
      2.3. genres table with columns:
      * id (Auto-incrementing primary key)
      * name (VARCHAR).


##### **3.** Backend: Create a PHP script to handle the following advanced backend operations, making use of SQL JOINs:

   * 3.1. List Books: Implement advanced filtering and sorting options for the book list,
     including filtering by genre, author, and publication year, using SQL JOINs 
     to fetch related data efficiently.

   * 3.2. Add Book: Enhance the book addition process by allowing users to associate 
     multiple authors and genres with a single book. Implement dynamic auto-suggest 
     fields for authors and genres during book addition.

   * 3.3. Edit Book: Extend the edit book feature to allow users to update book 
     details, including authors and genres, using SQL JOINs to manage these associations effectively.
   
   * 3.4. Delete Book: Allow users to delete books, ensuring that related author and
   genre associations are handled correctly using SQL JOINs.


##### **4.** Frontend: Create a simple HTML interface to interact with the backend. 
   You can use minimal styling, such as basic HTML forms and tables. The primary objective is to
   ensure that the front-end facilitates interaction with the back-end features.

##### **5.** Documentation: Provide comprehensive documentation, including installation instructions, API documentation, and a detailed explanation of the application's architecture.

-
-
-

######Bonus (Optional):
   * Implement additional SQL queries that demonstrate your expertise in using JOINs and
   subqueries for complex data retrieval.
   * Integrate third-party book APIs to fetch additional book details.
   * Implement a user dashboard for managing personal book collections and reviews.
   Submission:
   Please submit your code in a ZIP archive or provide a GitHub repository link with your project.
   Ensure that all components, including the database schema, PHP files, front-end code, and
   documentation, are included in your submission.