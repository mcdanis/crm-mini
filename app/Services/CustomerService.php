<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function searchCustomerForOrder($query)
    {
        $customers = Customer::where('full_name', 'like', "%{$query}%")->limit(20)->get();

        // Bangun HTML string
        $html = '';

        if ($customers->count()) {
            $html .= '<div class="list-group">';
            $html = '';

            foreach ($customers as $customer) {
                $html .= '
                    <div class="customer-item mb-2">
                        <label class="list-group-item d-flex align-items-center">
                            <input type="radio"
                                name="selected_customer"
                                value="' . $customer->id . '"
                                class="form-check-input me-2 customer-radio">
                            <span>' . htmlspecialchars($customer->full_name) . '</span>
                        </label>

                        <div class="customer-detail card shadow-sm p-3 mt-2 d-none">
                            <h6 class="card-title mb-2">' . htmlspecialchars($customer->full_name) . '</h6>
                            <p class="mb-1"><strong>Email:</strong> ' . htmlspecialchars($customer->email ?? '-') . '</p>
                            <p class="mb-1"><strong>Phone:</strong> ' . htmlspecialchars($customer->phone ?? '-') . '</p>
                            <p class="mb-0"><strong>Address:</strong> ' . htmlspecialchars($customer->address ?? '-') . '</p>
                        </div>
                    </div>
                ';
            }

            $html .= '</div>';
        } else {
            $html .= '<p class="text-muted">No customers found.</p>';
        }


        return $html;

    }
}
