# Competition Manager

## Installation Guide:
  1. git clone https://github.com/acelbeton/laravelbeadando.git
  1. cd competition-manager
  1. composer install
  1. npm install
  1. cp .env.example .env
  1. php artisan key:generate
  1. php artisan migrate --seed
  1. npm run dev
  1. php artisan serve
## Seeders
  - Added some dummy data to the tables
## Competitor
  - Only existing Users can be added to the selected Round as Competitors
## Date Handling
  - Competition year is unique
  - Round year must be the same as its Competition year
