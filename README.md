
# Friender

A web app where users can add friends either by making or accepting friend requests.

## Features

- Login/register user functionality
- User can make, accept or cancel a friend request
- User can view a list of all his friends


## Tech Stack

**Front-end framework:** TailwindCSS

**Back-end framework:** Laravel

## Installation

First, install backend dependencies

```bash
  composer install
```
Generate an .env file and edit it with your own database details

```bash
  cp .env.example .env
```
Then generate keys

```bash
  php artisan key:generate
```
Install frontend dependencies 

```bash
  npm install && npm run dev
```

Run migration code to setup database schema

```bash
  php artisan migrate
```
And if you wish to run seeders

```bash
  php artisan db:seed
```
