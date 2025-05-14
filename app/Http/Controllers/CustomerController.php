<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerResource;

class CustomerController extends BaseController
{
    public function index()
    {
        $invoices = Customer::all();

        return $this->sendResponse(
            CustomerResource::collection($invoices),
            'Customers retrieved successfully.'
        );
    }

    public function store(StoreCustomerRequest $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice = Customer::create($input);

        return $this->sendResponse(
            new CustomerResource($invoice),
            'Customer created successfully.'
        );
    }

    public function show($id)
    {
        $invoice = Customer::find($id);

        if (is_null($invoice)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse(
            new CustomerResource($invoice),
            'Customer retrieved successfully.'
        );
    }

    public function update(UpdateCustomerRequest $request, Customer $invoice)
    {
        $input = $request->all();

        $validator = Validator::make($input, $request->rules());

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $invoice->update($input);

        return $this->sendResponse(
            new CustomerResource($invoice),
            'Customer updated successfully.'
        );
    }

    public function destroy(Customer $invoice)
    {
        $invoice->delete();

        return $this->sendResponse([], 'Customer deleted successfully.');
    }
}
