<?php

use Botble\Base\Facades\AdminHelper;
use FriendsOfBotble\FacebookCatalogFeed\Http\Controllers\FacebookCatalogFeedController;
use Illuminate\Support\Facades\Route;

Route::prefix('facebook-catalog-feed')->name('facebook-catalog-feed.')->group(function () {
    Route::get('feed.xml', [FacebookCatalogFeedController::class, 'index'])->name('feed');
});

AdminHelper::registerRoutes(function () {
    Route::prefix('ecommerce/facebook-catalog-feed')->name('fob-facebook-catalog-feed.')->group(function () {
        Route::get('settings', [FacebookCatalogFeedController::class, 'settings'])->name('settings');
        Route::post('settings', [FacebookCatalogFeedController::class, 'updateSettings'])->name('settings.update');
    });
});