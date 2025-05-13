use App\Http\Controllers\InvoiceController;

Route::get('/items', [InvoiceController::class, 'index']);
Route::get('/items/{id}', [InvoiceController::class, 'show']);
Route::post('/items', [InvoiceController::class, 'store']);
Route::put('/items/{id}', [InvoiceController::class, 'update']);
Route::delete('/items/{id}', [InvoiceController::class, 'destroy']);
