# Laravel Task Management System

This repository contains a Laravel-based task management system with advanced features like role management, real-time notifications, background jobs, and task filtering. Follow the steps below to set up the project.

---

## **Setup Instructions**

### **1. Requirements**
- Install **Docker Desktop**.
- Set up **WSL** (Windows Subsystem for Linux) with Ubuntu.

---

### **2. Clone the Project**
1. Clone the repository.
2. Place the project folder inside your **Ubuntu folder** under your user account.

---

### **3. Configure Sail Alias**
1. Open a terminal and run:
   ```bash
   alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
   ```

---

### **4. Start Docker Services**
1. Start the services by running:
   ```bash
   sail up -d
   ```

---

### **5. Run Database Migrations**
1. Run the migrations:
   ```bash
   sail artisan migrate
   ```

---

### **6. Create Filament Admin User**
1. Create an admin user for Filament:
   ```bash
   sail artisan make:filament-user
   ```
2. Use the following credentials:
    - **Name**: Omar
    - **Email**: `omar@test.com`
    - **Password**: `123`

   Please use this email because it's set in the seeder for role and permission assignments.

---

### **7. Seed the Database**
1. Seed the database with initial data:
   ```bash
   sail artisan db:seed
   ```

---

### **8. Pusher & DataBase**
- Get the **Pusher** and **database** attributes from **.env.example** file

---


## **Features Overview**

### **1. Dashboard**
- Built with **Filament** to provide CRUD operations for Users and Tasks.
- Task management includes:
    - Filtering tasks by status.
    - Restricting edit and delete permissions to task owners.
- Role management is implemented using **spatie/laravel-permission**:
    - Admin role is restricted to access the dashboard.
    - Admin middleware is added in the `AdminPanelProvider`.

---

### **2. Authentication Policies**
- Policies are used to ensure only task owners can delete or update their tasks.

---

### **3. Real-Time Notifications**
- Filament Dashboard includes real-time notifications triggered when a task's status is updated.
- Implemented using **TaskStatusUpdated** event.
- To test this:
    1. Run the following in separate terminals:
       ```bash
       sail artisan queue:work
       ```
    2. Change the status of a task.

---

### **4. Background Jobs**
- **SendTaskSummaryJob** sends daily task summary emails to task owners.
- Email sending is configured using the **SMTP** mailer.
- The job is scheduled in `routes/console.php`:

- To test:
    1. Run the scheduler:
       ```bash
       sail artisan schedule:run
       ```
    2. In another terminal, run the queue worker:
       ```bash
       sail artisan queue:work
       ```
- Note: The job is scheduled daily. To test, you can modify it to run every minute.

---

### **5. Task Pagination and Filtering**
- **Pagination** is implemented for tasks.
- Tasks can be filtered by **title** and **status** using the `tucker-eric/eloquentfilter` package.

## API Documentation

Access the Postman collection for API endpoints and testing:
[Postman Documentation](https://documenter.getpostman.com/view/20088313/2sAYBa99QL)

---
