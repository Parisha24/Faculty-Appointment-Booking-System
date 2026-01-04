CREATE DATABASE IF NOT EXISTS faculty_appointments;
USE faculty_appointments;

-- USERS TABLE (Faculty + Students)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    student_id VARCHAR(20),          -- Enrollment ID (only for students)
    username VARCHAR(50),            -- For faculty login
    email VARCHAR(100),
    password VARCHAR(255) NOT NULL,
    department VARCHAR(50),
    role ENUM('faculty','student') NOT NULL
);

-- FACULTY SLOTS
CREATE TABLE slots (
    slot_id INT AUTO_INCREMENT PRIMARY KEY,
    faculty_id INT NOT NULL,
    slot_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_available BOOLEAN DEFAULT 1
);

-- APPOINTMENTS
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    slot_id INT NOT NULL,
    student_id INT NOT NULL,
    description TEXT NOT NULL,          -- Student reason
    status ENUM('Pending','Approved','Rejected') DEFAULT 'Pending',
    faculty_remark TEXT
);
