// Documentation route
Route::get('/docs', [App\Http\Controllers\DocsController::class, 'index'])->name('docs'); 