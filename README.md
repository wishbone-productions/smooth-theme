# Smooth Theme for laravel-admin

This is a `laravel-admin` (z-song) extension that makes the default bootstrap theme a bit more smooth also it provides an editor to adjust colors and settings

## Screenshot

![](./preview.png)

## Installation

```bash
// step 1
composer require laravel-admin-ext/smooth-theme

// step 2
php artisan vendor:publish --provider="Encore\SmoothTheme\SmoothThemeServiceProvider"

// step 3
php artisan migrate

// step 4
php artisan admin:import smooth-theme
```

## notes
make sure storage link is created

## Features
- a more smooth theme
- changes defautl grid actions
- disabled default color skin

options page
- menu width
- custom colors
- field border radius
- multiple themes