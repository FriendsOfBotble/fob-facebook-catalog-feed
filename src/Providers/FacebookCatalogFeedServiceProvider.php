<?php

namespace FriendsOfBotble\FacebookCatalogFeed\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use FriendsOfBotble\FacebookCatalogFeed\Services\FacebookCatalogFeedService;
use FriendsOfBotble\FacebookCatalogFeed\Widgets\FacebookCatalogFeedWidget;

class FacebookCatalogFeedServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->singleton(FacebookCatalogFeedService::class);
    }

    public function boot(): void
    {
        if (! is_plugin_active('ecommerce')) {
            return;
        }

        $this
            ->setNamespace('plugins/fob-facebook-catalog-feed')
            ->loadAndPublishConfigurations(['permissions', 'general'])
            ->loadHelpers()
            ->loadRoutes()
            ->loadAndPublishTranslations()
            ->loadAndPublishViews()
            ->loadMigrations();

        DashboardMenu::default()->beforeRetrieving(function () {
            DashboardMenu::make()
                ->registerItem([
                    'id' => 'cms-plugins-fob-facebook-catalog-feed',
                    'priority' => 9999,
                    'parent_id' => 'cms-plugins-ecommerce',
                    'name' => 'plugins/fob-facebook-catalog-feed::fob-facebook-catalog-feed.name',
                    'icon' => null,
                    'url' => route('fob-facebook-catalog-feed.settings'),
                    'permissions' => ['fob-facebook-catalog-feed.settings'],
                ]);
        });

        $this->app->booted(function () {
            register_widget(FacebookCatalogFeedWidget::class);
        });
    }
}
