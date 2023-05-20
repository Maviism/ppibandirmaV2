## INSTALATION

git clone
composer install
generate key
artisan migrate:fresh --seed
## CONFIGURATION

1. setup .env

2. ubah vendor/laravel/jetstream/src/Http/Livewire/UpdateProfileInformation
    mount function()
    $user = Auth::user();
    $this->state = $user->with('personalInformation')->first()->toArray();
    $this->state['encryptedUserId'] = $user::encryptUserId(Auth::id());

3. set app_url di env biar profile photonya ga error