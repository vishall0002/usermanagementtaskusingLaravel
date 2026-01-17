# User Management System

A Single Page Application Like User Management System built with **Laravel 12**, **jQuery**, and **Bootstrap 5**. This application handles all Create, Read, Update, Delete, and Restore operations asynchronously using AJAX, ensuring a smooth user experience without page reloads.

##  Features

### User Management (CRUD)
- **Add User**: Create new users via a modal form with real-time validation.
- **Edit User**: Update user details (Name, Email, Mobile, Address) seamlessly.
- **Delete User**: Soft delete users to safely remove them from the active list.
- **Restore User**: Restore soft-deleted users from the trash view.

### Advanced Functionality
- **AJAX-Powered**: All actions (Pagination, Search, CRUD) occur without reloading the page.
- **Live Search**: Filter users instantly by Name, Email, or Mobile number.
- **Pagination**: Dynamic pagination (set to 3 items per page) that updates content and links asynchronously.
- **Soft Delete Filter**: Toggle view to show "Active Users" or "Trashed Users" using a dedicated dropdown filter.

### Validation
- **Unique Fields**: Ensures Email and Mobile numbers are unique across the database.
- **Strict Mobile Validation**: Enforces 10-15 digit numeric format using Regex logic.
- **Client-Side Feedback**: Displays validation errors directly under the respective form fields.

## Technology Stack

- **Framework**: Laravel 12.47.0
- **Frontend**: Blade Templates, Bootstrap 5
- **Scripting**: jQuery (AJAX integration)
- **Database**: MySQL
- **Styling**: Bootstrap 5 (Responsive Design)

##  Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/vishall0002/usermanagementtaskusingLaravel.git
   cd usermanagementtaskusingLaravel
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   Copy the example environment file and configure your database credentials:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Migration**
   Run valid migrations to set up the schema:
   ```bash
   php artisan migrate
   ```

5. **Run Application**
   Start the local development server:
   ```bash
   php artisan serve
   ```
   Visit `http://localhost:8000` in your browser.

## Project Structure

- **Controller**: `app/Http/Controllers/UserController.php` (Handles all logic including AJAX responses)
- **Request**: `app/Http/Requests/UserRequest.php` (Handles validation rules)
- **Views**:
  - `resources/views/users/index.blade.php` (Main container)
  - `resources/views/users/partials/table_rows.blade.php` (Dynamic table rows)
  - `resources/views/users/modal.blade.php` (Add/Edit Modal)
- **Scripts**: `public/js/user-management.js` (Core AJAX logic)
