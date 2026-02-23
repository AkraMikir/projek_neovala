<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboard\DashboardController;
use App\Http\Controllers\AdminDashboard\KomentarController;
use App\Http\Controllers\AdminDashboard\ReviewController as AdminReviewController;
use App\Http\Controllers\AdminDashboard\{
    PromoController,
    TpjController,
    TpcController,
    GklController,
    PluController,
    GwcController,
    PgvController,
    BsrController,
    GpcController,
    SplController,
    TrackingController
};

// =====================================
// NEW ADMIN DASHBOARD ROUTES
// (Protected by auth:admin)
// =====================================

Route::middleware(['auth:admin'])->group(function () {

    // Main Dashboard
    Route::get('/admin/dashboard1', [DashboardController::class, 'index'])
        ->name('admin.dashboard1');

    // Komentar (Testimonials)
    Route::get('/admin/dashboard1/komentar', [KomentarController::class, 'index'])
        ->name('admin.dashboard1.komentar');
    Route::post('/admin/dashboard1/komentar', [KomentarController::class, 'store'])
        ->name('admin.dashboard1.komentar.store');
    Route::patch('/admin/dashboard1/komentar/{id}', [KomentarController::class, 'update'])
        ->name('admin.dashboard1.komentar.update');
    Route::delete('/admin/dashboard1/komentar/{id}', [KomentarController::class, 'destroy'])
        ->name('admin.dashboard1.komentar.destroy');

    // Promo
    Route::get('/admin/dashboard1/promo', [PromoController::class, 'index'])
        ->name('admin.dashboard1.promo');
    Route::post('/admin/dashboard1/promo', [PromoController::class, 'store'])
        ->name('admin.dashboard1.promo.store');
    Route::delete('/admin/dashboard1/promo/{id}', [PromoController::class, 'destroy'])
        ->name('admin.dashboard1.promo.destroy');

    // TPJ (Transpark Juanda)
    Route::get('/admin/dashboard1/tpj', [TpjController::class, 'index'])
        ->name('admin.dashboard1.tpj');
    Route::post('/admin/dashboard1/tpj/carousel', [TpjController::class, 'updateCarousel'])
        ->name('admin.dashboard1.tpj.updateCarousel');
    Route::post('/admin/dashboard1/tpj/room', [TpjController::class, 'storeRoom'])
        ->name('admin.dashboard1.tpj.storeRoom');
    Route::post('/admin/dashboard1/tpj/room/{id}', [TpjController::class, 'updateRoom'])
        ->name('admin.dashboard1.tpj.updateRoom');
    Route::delete('/admin/dashboard1/tpj/room/{id}', [TpjController::class, 'deleteRoom'])
        ->name('admin.dashboard1.tpj.deleteRoom');
    Route::patch('/admin/dashboard1/tpj/comment/{id}/apply', [TpjController::class, 'applyComment'])
        ->name('admin.dashboard1.tpj.applyComment');
    Route::patch('/admin/dashboard1/tpj/comment/{id}/unapply', [TpjController::class, 'unapplyComment'])
        ->name('admin.dashboard1.tpj.unapplyComment');
    Route::delete('/admin/dashboard1/tpj/comment/{id}', [TpjController::class, 'deleteComment'])
        ->name('admin.dashboard1.tpj.deleteComment');
    Route::get('/admin/dashboard1/tpj/form/{id}', [TpjController::class, 'viewFormDetail'])
        ->name('admin.dashboard1.tpj.viewFormDetail');
    Route::delete('/admin/dashboard1/tpj/form/{id}', [TpjController::class, 'deleteFormData'])
        ->name('admin.dashboard1.tpj.deleteFormData');

    // TPC (Transpark Cibubur)
    Route::get('/admin/dashboard1/tpc', [TpcController::class, 'index'])->name('admin.dashboard1.tpc');
    Route::post('/admin/dashboard1/tpc/carousel', [TpcController::class, 'updateCarousel'])->name('admin.dashboard1.tpc.updateCarousel');
    Route::post('/admin/dashboard1/tpc/room', [TpcController::class, 'storeRoom'])->name('admin.dashboard1.tpc.storeRoom');
    Route::post('/admin/dashboard1/tpc/room/{id}', [TpcController::class, 'updateRoom'])->name('admin.dashboard1.tpc.updateRoom');
    Route::delete('/admin/dashboard1/tpc/room/{id}', [TpcController::class, 'deleteRoom'])->name('admin.dashboard1.tpc.deleteRoom');
    Route::patch('/admin/dashboard1/tpc/comment/{id}/apply', [TpcController::class, 'applyComment'])->name('admin.dashboard1.tpc.applyComment');
    Route::patch('/admin/dashboard1/tpc/comment/{id}/unapply', [TpcController::class, 'unapplyComment'])->name('admin.dashboard1.tpc.unapplyComment');
    Route::delete('/admin/dashboard1/tpc/comment/{id}', [TpcController::class, 'deleteComment'])->name('admin.dashboard1.tpc.deleteComment');
    Route::get('/admin/dashboard1/tpc/form/{id}', [TpcController::class, 'viewFormDetail'])->name('admin.dashboard1.tpc.viewFormDetail');
    Route::delete('/admin/dashboard1/tpc/form/{id}', [TpcController::class, 'deleteFormData'])->name('admin.dashboard1.tpc.deleteFormData');

    // GKL (Grand Kamala Lagoon)
    Route::get('/admin/dashboard1/gkl', [GklController::class, 'index'])->name('admin.dashboard1.gkl');
    Route::post('/admin/dashboard1/gkl/carousel', [GklController::class, 'updateCarousel'])->name('admin.dashboard1.gkl.updateCarousel');
    Route::post('/admin/dashboard1/gkl/room', [GklController::class, 'storeRoom'])->name('admin.dashboard1.gkl.storeRoom');
    Route::post('/admin/dashboard1/gkl/room/{id}', [GklController::class, 'updateRoom'])->name('admin.dashboard1.gkl.updateRoom');
    Route::delete('/admin/dashboard1/gkl/room/{id}', [GklController::class, 'deleteRoom'])->name('admin.dashboard1.gkl.deleteRoom');
    Route::patch('/admin/dashboard1/gkl/comment/{id}/apply', [GklController::class, 'applyComment'])->name('admin.dashboard1.gkl.applyComment');
    Route::patch('/admin/dashboard1/gkl/comment/{id}/unapply', [GklController::class, 'unapplyComment'])->name('admin.dashboard1.gkl.unapplyComment');
    Route::delete('/admin/dashboard1/gkl/comment/{id}', [GklController::class, 'deleteComment'])->name('admin.dashboard1.gkl.deleteComment');
    Route::get('/admin/dashboard1/gkl/form/{id}', [GklController::class, 'viewFormDetail'])->name('admin.dashboard1.gkl.viewFormDetail');
    Route::delete('/admin/dashboard1/gkl/form/{id}', [GklController::class, 'deleteFormData'])->name('admin.dashboard1.gkl.deleteFormData');

    // PLU (Patraland Urbano)
    Route::get('/admin/dashboard1/plu', [PluController::class, 'index'])->name('admin.dashboard1.plu');
    Route::post('/admin/dashboard1/plu/carousel', [PluController::class, 'updateCarousel'])->name('admin.dashboard1.plu.updateCarousel');
    Route::post('/admin/dashboard1/plu/room', [PluController::class, 'storeRoom'])->name('admin.dashboard1.plu.storeRoom');
    Route::post('/admin/dashboard1/plu/room/{id}', [PluController::class, 'updateRoom'])->name('admin.dashboard1.plu.updateRoom');
    Route::delete('/admin/dashboard1/plu/room/{id}', [PluController::class, 'deleteRoom'])->name('admin.dashboard1.plu.deleteRoom');
    Route::patch('/admin/dashboard1/plu/comment/{id}/apply', [PluController::class, 'applyComment'])->name('admin.dashboard1.plu.applyComment');
    Route::patch('/admin/dashboard1/plu/comment/{id}/unapply', [PluController::class, 'unapplyComment'])->name('admin.dashboard1.plu.unapplyComment');
    Route::delete('/admin/dashboard1/plu/comment/{id}', [PluController::class, 'deleteComment'])->name('admin.dashboard1.plu.deleteComment');
    Route::get('/admin/dashboard1/plu/form/{id}', [PluController::class, 'viewFormDetail'])->name('admin.dashboard1.plu.viewFormDetail');
    Route::delete('/admin/dashboard1/plu/form/{id}', [PluController::class, 'deleteFormData'])->name('admin.dashboard1.plu.deleteFormData');

    // GWC (Gateway Cicadas)
    Route::get('/admin/dashboard1/gwc', [GwcController::class, 'index'])->name('admin.dashboard1.gwc');
    Route::post('/admin/dashboard1/gwc/carousel', [GwcController::class, 'updateCarousel'])->name('admin.dashboard1.gwc.updateCarousel');
    Route::post('/admin/dashboard1/gwc/room', [GwcController::class, 'storeRoom'])->name('admin.dashboard1.gwc.storeRoom');
    Route::post('/admin/dashboard1/gwc/room/{id}', [GwcController::class, 'updateRoom'])->name('admin.dashboard1.gwc.updateRoom');
    Route::delete('/admin/dashboard1/gwc/room/{id}', [GwcController::class, 'deleteRoom'])->name('admin.dashboard1.gwc.deleteRoom');
    Route::patch('/admin/dashboard1/gwc/comment/{id}/apply', [GwcController::class, 'applyComment'])->name('admin.dashboard1.gwc.applyComment');
    Route::patch('/admin/dashboard1/gwc/comment/{id}/unapply', [GwcController::class, 'unapplyComment'])->name('admin.dashboard1.gwc.unapplyComment');
    Route::delete('/admin/dashboard1/gwc/comment/{id}', [GwcController::class, 'deleteComment'])->name('admin.dashboard1.gwc.deleteComment');
    Route::get('/admin/dashboard1/gwc/form/{id}', [GwcController::class, 'viewFormDetail'])->name('admin.dashboard1.gwc.viewFormDetail');
    Route::delete('/admin/dashboard1/gwc/form/{id}', [GwcController::class, 'deleteFormData'])->name('admin.dashboard1.gwc.deleteFormData');

    // PGV (Podomoro Golf View)
    Route::get('/admin/dashboard1/pgv', [PgvController::class, 'index'])->name('admin.dashboard1.pgv');
    Route::post('/admin/dashboard1/pgv/carousel', [PgvController::class, 'updateCarousel'])->name('admin.dashboard1.pgv.updateCarousel');
    Route::post('/admin/dashboard1/pgv/room', [PgvController::class, 'storeRoom'])->name('admin.dashboard1.pgv.storeRoom');
    Route::post('/admin/dashboard1/pgv/room/{id}', [PgvController::class, 'updateRoom'])->name('admin.dashboard1.pgv.updateRoom');
    Route::delete('/admin/dashboard1/pgv/room/{id}', [PgvController::class, 'deleteRoom'])->name('admin.dashboard1.pgv.deleteRoom');
    Route::patch('/admin/dashboard1/pgv/comment/{id}/apply', [PgvController::class, 'applyComment'])->name('admin.dashboard1.pgv.applyComment');
    Route::patch('/admin/dashboard1/pgv/comment/{id}/unapply', [PgvController::class, 'unapplyComment'])->name('admin.dashboard1.pgv.unapplyComment');
    Route::delete('/admin/dashboard1/pgv/comment/{id}', [PgvController::class, 'deleteComment'])->name('admin.dashboard1.pgv.deleteComment');
    Route::get('/admin/dashboard1/pgv/form/{id}', [PgvController::class, 'viewFormDetail'])->name('admin.dashboard1.pgv.viewFormDetail');
    Route::delete('/admin/dashboard1/pgv/form/{id}', [PgvController::class, 'deleteFormData'])->name('admin.dashboard1.pgv.deleteFormData');

    // BSR (Bassura)
    Route::get('/admin/dashboard1/bsr', [BsrController::class, 'index'])->name('admin.dashboard1.bsr');
    Route::post('/admin/dashboard1/bsr/carousel', [BsrController::class, 'updateCarousel'])->name('admin.dashboard1.bsr.updateCarousel');
    Route::post('/admin/dashboard1/bsr/room', [BsrController::class, 'storeRoom'])->name('admin.dashboard1.bsr.storeRoom');
    Route::post('/admin/dashboard1/bsr/room/{id}', [BsrController::class, 'updateRoom'])->name('admin.dashboard1.bsr.updateRoom');
    Route::delete('/admin/dashboard1/bsr/room/{id}', [BsrController::class, 'deleteRoom'])->name('admin.dashboard1.bsr.deleteRoom');
    Route::patch('/admin/dashboard1/bsr/comment/{id}/apply', [BsrController::class, 'applyComment'])->name('admin.dashboard1.bsr.applyComment');
    Route::patch('/admin/dashboard1/bsr/comment/{id}/unapply', [BsrController::class, 'unapplyComment'])->name('admin.dashboard1.bsr.unapplyComment');
    Route::delete('/admin/dashboard1/bsr/comment/{id}', [BsrController::class, 'deleteComment'])->name('admin.dashboard1.bsr.deleteComment');
    Route::get('/admin/dashboard1/bsr/form/{id}', [BsrController::class, 'viewFormDetail'])->name('admin.dashboard1.bsr.viewFormDetail');
    Route::delete('/admin/dashboard1/bsr/form/{id}', [BsrController::class, 'deleteFormData'])->name('admin.dashboard1.bsr.deleteFormData');

    // GPC (Green Pramuka City)
    Route::get('/admin/dashboard1/gpc', [GpcController::class, 'index'])->name('admin.dashboard1.gpc');
    Route::post('/admin/dashboard1/gpc/carousel', [GpcController::class, 'updateCarousel'])->name('admin.dashboard1.gpc.updateCarousel');
    Route::post('/admin/dashboard1/gpc/room', [GpcController::class, 'storeRoom'])->name('admin.dashboard1.gpc.storeRoom');
    Route::post('/admin/dashboard1/gpc/room/{id}', [GpcController::class, 'updateRoom'])->name('admin.dashboard1.gpc.updateRoom');
    Route::delete('/admin/dashboard1/gpc/room/{id}', [GpcController::class, 'deleteRoom'])->name('admin.dashboard1.gpc.deleteRoom');
    Route::patch('/admin/dashboard1/gpc/comment/{id}/apply', [GpcController::class, 'applyComment'])->name('admin.dashboard1.gpc.applyComment');
    Route::patch('/admin/dashboard1/gpc/comment/{id}/unapply', [GpcController::class, 'unapplyComment'])->name('admin.dashboard1.gpc.unapplyComment');
    Route::delete('/admin/dashboard1/gpc/comment/{id}', [GpcController::class, 'deleteComment'])->name('admin.dashboard1.gpc.deleteComment');
    Route::get('/admin/dashboard1/gpc/form/{id}', [GpcController::class, 'viewFormDetail'])->name('admin.dashboard1.gpc.viewFormDetail');
    Route::delete('/admin/dashboard1/gpc/form/{id}', [GpcController::class, 'deleteFormData'])->name('admin.dashboard1.gpc.deleteFormData');

    // SPL (Springlake Summarecon)
    Route::get('/admin/dashboard1/spl', [SplController::class, 'index'])->name('admin.dashboard1.spl');
    Route::post('/admin/dashboard1/spl/carousel', [SplController::class, 'updateCarousel'])->name('admin.dashboard1.spl.updateCarousel');
    Route::post('/admin/dashboard1/spl/room', [SplController::class, 'storeRoom'])->name('admin.dashboard1.spl.storeRoom');
    Route::post('/admin/dashboard1/spl/room/{id}', [SplController::class, 'updateRoom'])->name('admin.dashboard1.spl.updateRoom');
    Route::delete('/admin/dashboard1/spl/room/{id}', [SplController::class, 'deleteRoom'])->name('admin.dashboard1.spl.deleteRoom');
    Route::patch('/admin/dashboard1/spl/comment/{id}/apply', [SplController::class, 'applyComment'])->name('admin.dashboard1.spl.applyComment');
    Route::patch('/admin/dashboard1/spl/comment/{id}/unapply', [SplController::class, 'unapplyComment'])->name('admin.dashboard1.spl.unapplyComment');
    Route::delete('/admin/dashboard1/spl/comment/{id}', [SplController::class, 'deleteComment'])->name('admin.dashboard1.spl.deleteComment');
    Route::get('/admin/dashboard1/spl/form/{id}', [SplController::class, 'viewFormDetail'])->name('admin.dashboard1.spl.viewFormDetail');
    Route::delete('/admin/dashboard1/spl/form/{id}', [SplController::class, 'deleteFormData'])->name('admin.dashboard1.spl.deleteFormData');

    // Tracking
    Route::get('/admin/dashboard1/tracking', [TrackingController::class, 'index'])
        ->name('admin.dashboard1.tracking');
    Route::get('/admin/dashboard1/tracking/export', [TrackingController::class, 'exportData'])
        ->name('admin.dashboard1.tracking.export');

    // Reviews (unified)
    Route::get('/admin/dashboard1/reviews', [AdminReviewController::class, 'index'])
        ->name('admin.dashboard1.reviews.index');
    Route::get('/admin/dashboard1/reviews/data', [AdminReviewController::class, 'data'])
        ->name('admin.dashboard1.reviews.data');
    Route::get('/admin/dashboard1/reviews/create', [AdminReviewController::class, 'create'])
        ->name('admin.dashboard1.reviews.create');
    Route::post('/admin/dashboard1/reviews', [AdminReviewController::class, 'store'])
        ->name('admin.dashboard1.reviews.store');
    Route::get('/admin/dashboard1/reviews/{review}/edit', [AdminReviewController::class, 'edit'])
        ->name('admin.dashboard1.reviews.edit');
    Route::patch('/admin/dashboard1/reviews/{review}', [AdminReviewController::class, 'update'])
        ->name('admin.dashboard1.reviews.update');
    Route::delete('/admin/dashboard1/reviews/{review}', [AdminReviewController::class, 'destroy'])
        ->name('admin.dashboard1.reviews.destroy');
    Route::post('/admin/dashboard1/reviews/{review}/replies', [AdminReviewController::class, 'storeReply'])
        ->name('admin.dashboard1.reviews.replies.store');
    Route::patch('/admin/dashboard1/reviews/{review}/replies/{reply}', [AdminReviewController::class, 'updateReply'])
        ->name('admin.dashboard1.reviews.replies.update');
    Route::delete('/admin/dashboard1/reviews/{review}/replies/{reply}', [AdminReviewController::class, 'destroyReply'])
        ->name('admin.dashboard1.reviews.replies.destroy');
    Route::delete('/admin/dashboard1/reviews/{review}/media/{medium}', [AdminReviewController::class, 'deleteMedia'])
        ->name('admin.dashboard1.reviews.media.destroy');
});
