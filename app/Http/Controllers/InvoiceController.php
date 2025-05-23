<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Http\Requests\DeleteMultipleInvoiceRequest;
use App\Http\Resources\InvoiceResource;

class InvoiceController extends BaseController
{
    public function index()
    {
        /** TODO: fetch by authId */
        $invoices = Invoice::all();

        return $this->sendResponse(
            InvoiceResource::collection($invoices),
            'Invoices retrieved successfully.'
        );
    }

    public function store(StoreInvoiceRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input['userId'] = auth('api')->user()->id;

        $invoice = Invoice::create($input);

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice created successfully.'
        );
    }

    public function show($id)
    {
        /** TODO: fetch by auth id else 403 */
        $invoice = Invoice::find($id);

        if (is_null($invoice)) {
            return $this->sendError('Invoice not found.');
        }

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice retrieved successfully.'
        );
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        /** TODO: check if userId === authId else 403 */
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice->update($input);

        return $this->sendResponse(
            new InvoiceResource($invoice),
            'Invoice updated successfully.'
        );
    }

    public function destroy(Invoice $invoice)
    {
        /** TODO: check if userId === authId else 403 */

        $invoice->delete();

        return $this->sendResponse([], 'Invoice deleted successfully.');
    }

    public function destroyMultiple(DeleteMultipleInvoiceRequest $request)
    {
        /** TODO: fetchBy authId else 403 */
        $ids = explode(',', $request->ids);

        Invoice::whereIn('id', $ids)->delete();

        return $this->sendResponse([], 'Invoices deleted successfully.');
    }
}
