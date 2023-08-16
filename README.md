## About Project
    This project is about a imaginary wood distributing company that need CRUD functionality for suppliers and products. 
    This project consits of 2 parts:
        -   Monolith (App with UI)
        -   API
## How to run
    - Pull the project pro repository
    - run 'composer install'
    - create ".env" file in the project root  copying ".env.testing". 
    - run 'php artisan key:generate'
    - create database and adjust .env files DB credentials accordingly
    - run 'php artisan serve'
    - to seed database 'php artisan db:seed'
    - For UI, 'http://localhost:8000/' is the main page. Here you travel through pages using side-nav on the left
    - For API, please check 'http://localhost:8000/api/docs' for swagger documentation.
    - To test the application, please run 'php artisan test'

## The Scenario / Ideation
    - This is a simple CRUD application for a wood distributing company.
    - The app is built CRUD operations for products and productVariations for IT and an API.
    - The purpose of this app is to prove that the 20 rules of development listed here works: https://www.notion.so/timberhub/Tech-excellence-brainstorming-ef7a1ac715714de8bea9eaa725bb663a#ded869868ce043f097a069184617bd96.
    - The app is built with the idea of having a monolith and an API. The monolith is built with Laravel and Livewire. The API is built with Laravel and Sanctum.
    - In the app the consuming logic (Livewire/API) is separated from the business logic (Services/Repositories).
    - The idea of having this much layer for a simple application is overkill, but the idea is to show that the application is scalable and can be extended easily.
   
CHEERS!
