# Book-Rental-System (BRS)
Made with Laravel v11

In this system, there are functions accessible to anonymous users. They can search for books by author or title, list books by genre, and view the datasheet of a selected book.

There are two types of users in this BRS: readers and librarians. As a registered and authenticated (logged in) reader, I can borrow a book, view my active book rentals, and view the details of a selected book rental. As a librarian, I have the ability to add, edit, or delete a book, add, edit, or delete a genre, list book rentals, view the details of a book rental, and change some status on a book rental, like status, deadline, note.

The home project is implemented as a Laravel application using a local SQLite database.

For models, the User table is already created. Extended ones include fields for id, name, email (unique), email_verified_at (timestamp, nullable), password, is_librarian (boolean, default: false), remember_token, and timestamps (created_at, updated_at).

The Book model includes fields for id, title, authors, description (text, nullable), released_at (date), cover image (nullable), pages, language_code (default: hu), isbn (unique), in_stock, and timestamps.

The Genre model has fields for id, name, and style (an enum of various UI colors), along with timestamps.

The Borrow model includes fields for id, reader_id (with foreign key constraints), book_id (with foreign key constraints), status (an enum of PENDING, ACCEPTED, REJECTED, RETURNED), request_processed_at (datetime, nullable), request_managed_by (with foreign key constraints), deadline (datetime, nullable), returned_at (datetime, nullable), return_managed_by (with foreign key constraints), and timestamps.

A book may have many genres, and a genre may belong to many books. A book may have many rentals, but a rental belongs to only one book. A reader may have many book rentals, but a rental belongs to only one user. A librarian may manage many rental requests and returns, but each request or return can only be managed by one librarian.

Public functions include a navigation bar common layout, a main page displaying counts of users, genres, books, and active rentals, a list of genres each linking to a genre-specific page, and a book search function. The book detail page shows comprehensive information about the book, and registration and login functions are available for users.

Reader-specific functions are accessible only after logging in, including borrowing a book, viewing ongoing and past rentals, and specific rental details.

Librarian-specific functions, also requiring login, include managing books and genres, handling rental requests and returns, and editing details on the rental status and deadlines.

Finally, there's a common profile page accessible from the navigation bar showing user details such as name, email, and role.
