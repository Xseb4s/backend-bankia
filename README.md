# Simple Backend for Credit Application System - Laravel

This repository contains the source code of a simple backend built on Laravel, designed to handle credit applications for clients of a fictitious bank called "IA Bank". The backend provides an API for clients to submit credit applications, which are then reviewed by advisors and approved by the general manager.

## Key Features

- **Request Management**: Clients can submit credit applications through the provided API.
- **Advisor Evaluation**: Advisors can review and evaluate credit applications submitted by clients.
- **General Manager Approval**: The general manager can approve credit applications evaluated by advisors, thus creating the corresponding credit.

## Usage

1. Clone the repository: `git clone https://github.com/Xseb4s/backend-bankia`
2. Install dependencies: `composer install`
3. Configure the database in the `.env` file
4. Run database migrations: `php artisan migrate`
5. Start the server: `php artisan serve`
