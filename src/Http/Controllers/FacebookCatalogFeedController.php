<?php

namespace FriendsOfBotble\FacebookCatalogFeed\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use FriendsOfBotble\FacebookCatalogFeed\Services\FacebookCatalogFeedService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;

class FacebookCatalogFeedController extends BaseController
{
    public function __construct(
        protected FacebookCatalogFeedService $facebookCatalogFeedService
    ) {
    }

    public function index(Request $request)
    {
        if (! setting('fob_facebook_catalog_feed_enabled', true)) {
            abort(404);
        }

        $type = $request->input('type', 'all');

        // Stream the response directly without caching for large feeds
        return $this->facebookCatalogFeedService->streamFeed($type);
    }

    public function settings()
    {
        $this->pageTitle(trans('plugins/fob-facebook-catalog-feed::fob-facebook-catalog-feed.settings.title'));

        return view('plugins/fob-facebook-catalog-feed::admin.settings');
    }

    public function updateSettings(Request $request, BaseHttpResponse $response)
    {
        $request->validate([
            'enabled' => 'required|boolean',
            'include_out_of_stock' => 'required|boolean',
            'include_variations' => 'required|boolean',
            'brand_attribute' => 'nullable|string',
            'condition' => 'required|in:new,refurbished,used',
            'availability_in_stock' => 'required|in:in stock,available for order,preorder',
            'availability_out_of_stock' => 'required|in:out of stock,discontinued',
        ]);

        foreach ($request->except(['_token']) as $key => $value) {
            setting()->set('fob_facebook_catalog_feed_' . $key, $value);
        }

        setting()->save();

        // Clear all feed caches when settings are updated
        Cache::forget('facebook_catalog_feed_all');
        Cache::forget('facebook_catalog_feed_new');
        Cache::forget('facebook_catalog_feed_featured');
        Cache::forget('facebook_catalog_feed_on_sale');

        return $response
            ->setPreviousUrl(route('fob-facebook-catalog-feed.settings'))
            ->setMessage(trans('core/base::notices.update_success_message'));
    }
}
