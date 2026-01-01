-- Create Database
CREATE DATABASE IF NOT EXISTS faculty_appointments;
USE faculty_appointments;

-- Users table
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    role ENUM('student','faculty','admin') NOT NULL
);

-- Slots table (created by admin)
CREATE TABLE slots (
    slot_id INT AUTO_INCREMENT PRIMARY KEY,
    faculty_id INT NOT NULL,
    slot_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    is_available BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (faculty_id) REFERENCES users(user_id)
);

-- Appointments table (booked by students)
CREATE TABLE appointments (
    appointment_id INT AUTO_INCREMENT PRIMARY KEY,
    slot_id INT NOT NULL,
    student_id INT NOT NULL,
    status ENUM('pending','approved','rejected') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (slot_id) REFERENCES slots(slot_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id)
);
