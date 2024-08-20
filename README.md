# Competition Manager

## Installation Guide:
  - git clone https://github.com/acelbeton/laravelbeadando.git
  - cd laravelbeadando/competition-manager
  - composer install
  - npm install
  - cp .env.example .env
  - php artisan key:generate
  - php artisan migrate --seed
  - npm run dev
  - php artisan serve
## Seeders
  - Added some dummy data to the tables
## Competitor
  - Only from existing users you can add competitors to the selected rounds
## Date Handling
  - Competition year is unique
  - Round year must be the same as it's Competition year
