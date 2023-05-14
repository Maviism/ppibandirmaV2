## INSTALATION

git clone
composer install
generate key
artisan migrate:fresh --seed
## CONFIGURATION

1. setup .env

2. ubah vendor/laravel/jetstream/src/Http/Livewire/UpdateProfileInformation
$this->state = Auth::user()->with('personalInformation')->first()->toArray();

3. set app_url di env biar profile photonya ga error