# Delnee Travel Data System (Graduation Project)

## Overview
This project represents a data-driven system designed to support travel planning by managing and retrieving structured data related to users, countries, hotels, and tourist destinations.

Originally developed as a web application, this repository focuses on the underlying data model, SQL usage, and how data flows through the system.

---

## Key Features
- User authentication system (login/logout)
- Dynamic retrieval of countries and tourist locations
- Database-driven content rendering
- Booking system for hotels and travel-related services

---

## Tech Stack
- PHP (server-side logic)
- MySQL (relational database)
- SQL (data querying and filtering)

---

## Database Design

The system is built using a relational database with the following core entities:

- Users (authentication data)
- Countries (travel destinations)
- Hotels (linked to countries)
- Rooms (linked to hotels)
- Places (tourist attractions linked to countries)
- Bookings (user transactions)

This structure reflects a real-world data model with relationships between entities.

---

## Example Queries

Retrieve places for a selected country:

```sql
SELECT * FROM places WHERE country_id = ?;
```

Retrieve rooms for a specific hotel:

```sql
SELECT * FROM rooms WHERE hotel_id = ?;
```

---

## Data Flow

1. User selects a country  
2. System sends request to backend  
3. SQL query retrieves related data (places, hotels, etc.)  
4. Results are displayed dynamically  

---

## Screenshots

### Homepage

### Country Selection & Places Data

### Hotel & Room Filtering

### Booking Data Input

---

## Project Status

This project is partially preserved due to data loss. Core backend logic and database interaction remain available.

---

## Key Learnings

- Working with relational databases (MySQL)
- Writing SQL queries for dynamic data retrieval
- Designing data models for real-world applications

