<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RouteServiceProvider extends ServiceProvider
{
  /**
   * This namespace is applied to your controller routes.
   *
   * In addition, it is set as the URL generator's root namespace.
   *
   * @var string
   */
  protected $namespace = 'App\Http\Controllers';

  /**
   * Define your route model bindings, pattern filters, etc.
   *
   * @return void
   */
  public function boot()
  {
    //

    parent::boot();

    $this->configureRateLimiting();
  }

  /**
   * Define the routes for the application.
   *
   * @return void
   */
  public function map()
  {
     $this->mapApiRoutes();

     $this->mapAgencySignupOptionRoutes();

     $this->mapAdminRoutes();

     $this->mapAffiliateRoutes();

     $this->mapRefundRoutes();

     $this->mapClubPointsRoutes();

     $this->mapOtpRoutes();

     $this->mapOfflinePaymentRoutes();

     $this->mapAfricanPaymentGatewayRoutes();

     $this->mapPaytmRoutes();

     $this->mapPosRoutes();

     $this->mapSellerPackageRoutes();

     $this->mapDeliveryBoyRoutes();

     $this->mapAuctionRoutes();

     $this->mapWholesaleRoutes();

     $this->mapWebRoutes();

     $this->sliderWebRoutes();

     $this->managemenuWebRoutes();

     $this->warehouseWebRoutes();

     $this->inventoryWebRoutes();

     $this->propertyTypeWebRoutes();
     
     $this->propertyBedWebRoutes();

     $this->propertyPurposeWebRoutes();

     $this->propertyBathWebRoutes();

     $this->propertyConditionWebRoutes();
     
     $this->propertyUnitsWebRoutes();

     $this->propertyReportsWebRoutes();

     $this->propertyInquiriesWebRoutes();

     $this->propertyTourTypeWebRoutes();

     $this->propertyAmenityWebRoutes();

    $this->mapLocationRoutes();

     

    // $this->mapInstallRoutes();

    //$this->mapUpdateRoutes();
  }

  /**
   * Define the "b2b" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWholesaleRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/wholesale.php'));
  }

  /**
   * Define the "delivery boy" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapDeliveryBoyRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/delivery_boy.php'));
  }

  /**
   * Define the "agency signup options" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAgencySignupOptionRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/agency_signup_options.php'));
  }

    /**
   * Define the "auction" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAuctionRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/auction.php'));
  }

  /**
   * Define the "seller package" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapSellerPackageRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/seller_package.php'));
  }

  /**
   * Define the "affiliate" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAffiliateRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/affiliate.php'));
  }

  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapOfflinePaymentRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/offline_payment.php'));
  }


  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapPaytmRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/paytm.php'));
  }

  /**
   * Define the "offline payment" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAfricanPaymentGatewayRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/african_pg.php'));
  }

  /**
   * Define the "refund" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapRefundRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/refund_request.php'));
  }

  /**
   * Define the "club points" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapClubPointsRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/club_points.php'));
  }

  /**
   * Define the "location" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapLocationRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/locations.php'));
  }

  /**
   * Define the "OTP System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapOtpRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/otp.php'));
  }

  /**
   * Define the "POS System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapPosRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/pos.php'));
  }

  /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyTypeWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_type.php'));
  }

    /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyBedWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_bed.php'));
  }

   /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyPurposeWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_purposes.php'));
  }

 /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyBathWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_baths.php'));
  }

  /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyConditionWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_conditions.php'));
  }

  /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyUnitsWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_units.php'));
  }

  /**
   * Define the "Product Inquiry System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyInquiriesWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_inquiries.php'));
  }

  /**
   * Define the "Product Report System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyReportsWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_reports.php'));
  }
  /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyTourTypeWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_tour_types.php'));
  }

  /**
   * Define the "Product Type System" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function propertyAmenityWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/property_amenities.php'));
  }

  /**
   * Define the "updating" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapUpdateRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/update.php'));
  }

  /**
   * Define the "installation" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapInstallRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/install.php'));
  }

  /**
   * Define the "web" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapWebRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/web.php'));
  }

  /**
   * Define the "admin" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function mapAdminRoutes()
  {
    Route::middleware('web')
       ->namespace($this->namespace)
       ->group(base_path('routes/admin.php'));
  }

  /**
   * Define the "api" routes for the application.
   *
   * These routes are typically stateless.
   *
   * @return void
   */
  protected function mapApiRoutes()
  {
    Route::prefix('api')
       ->middleware('api')
       ->namespace($this->namespace)
       ->group(base_path('routes/api.php'));
  }

  /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(600)->by(optional($request->user())->id ?: $request->ip());
        });
    }

    /**
   * Define the "slider" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function sliderWebRoutes()
  {
    if (addon_is_activated('slider')){
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/slider_route.php'));
    }
  }

    /**
   * Define the "managemenu" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function managemenuWebRoutes()
  {
    if (addon_is_activated('manage_menu')){
        Route::middleware('web')
           ->namespace($this->namespace)
           ->group(base_path('routes/manage_route.php'));
    }
  }

   /**
   * Define the "warehouse" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function warehouseWebRoutes()
  {
    if (addon_is_activated('warehouse')){
        Route::middleware('web')
           ->namespace($this->namespace)
           ->group(base_path('routes/warehouse.php'));
    }
  }

  /**
   * Define the "warehouse" routes for the application.
   *
   * These routes all receive session state, CSRF protection, etc.
   *
   * @return void
   */
  protected function inventoryWebRoutes()
  {
    // if (addon_is_activated('inventory')){
        Route::middleware('web')
           ->namespace($this->namespace)
           ->group(base_path('routes/inventory.php'));
    // }
  }

}
