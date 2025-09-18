<?php

namespace App\Services;

use App\Helpers\AuthHelper;
use App\Models\Order;
use App\Models\Customer;
use App\Models\CustomerStat;
use App\Models\CustomerTag;
use App\Models\OrderItem;
use App\Models\Payment;

class OrderService
{
    public $userId;

    public function proccessOrder($data)
    {
        $this->userId = AuthHelper::getUserId();
        if (isset($data['customer_type'])) {
            $this->createCustomer($data);
        } else {
            $this->updateCustomerStat($data, $data['selected_customer']);
        }

        return "Order has been created!";
    }

    public function createOrder($data, $customerId)
    {
        // echo var_dump($data);
        if (empty($data['booked_at'])) {
            $bookedAt = $data['order_date'];
        } else {
            $bookedAt = $data['booked_at'];
        }
        $order = Order::create([
            'customer_id' => $customerId,
            'status' => $data['order_status'],
            'order_date' => $data['order_date'] ?? date('Y-m-d H:i:s'),
            'note' => $data['order_note'],
            'payment_note' => $data['payment_note'],
            'references' => '',
            'payment_method' => '',
            'total_amount' => $data['total'],
            'total_paid' => $data['amount_paid'] ?: 0,
            'scheduled_at' => $bookedAt,
            'created_by' => $this->userId,
        ]);
        $this->createOrderItems($data, $order->id);
        if (isset($data['amound_paid'])) {
            $this->createPayment($data, $order->id);
        }
    }

    public function createOrderItems($data, $orderId)
    {
        $dataItems = [];
        for ($i = 0; $i < count($data['item']); $i++) {
            $price = (float) $data['price'][$i];
            $customPrice = !empty($data['custom_price'][$i]) ? (float) $data['custom_price'][$i] : null;

            $discount = 0.00;

            if (!is_null($customPrice)) {
                $discount = $customPrice - $price;
            }

            $dataItems[] = [
                'order_id'    => $orderId,
                'service_id'  => $data['item'][$i],
                'name'        => $data['service_name'][$i] ?? '',
                'quantity'    => (int) $data['qty'][$i],
                'unit_price'  => $price,
                'discount'    => $discount,
                'custom_price' => $customPrice,
            ];
        }
        $items = OrderItem::insert($dataItems);
    }

    public function createPayment($data, $orderId)
    {
        Payment::insert([
            'order_id' => $orderId,
            'payment_date' => $data['order_date'],
            'amount' => $data['amount_paid'] ?: 0,
            'payment_method' => $data['payment_method'],
            'reference' => $data['reference'],
            'note' => $data['payment_note'],
            'created_by' => $this->userId,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function updateCustomerStat($data, $id)
    {
        $customerStat = CustomerStat::where('customer_id', $id);
        $totalOrders = (int)(array_sum($data['qty']) ?? 0);
        $totalSpent = (int)($data['total'] ?? 0);
        if ($customerStat->exists()) {
            $customerStat->update([
                'total_orders' => (int)($customerStat->total_orders ?? 0) + $totalOrders,
                'total_spent' => (int)($customerStat->total_spent ?? 0) + $totalSpent,
                'last_order_at' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $customerStat = CustomerStat::create([
                'customer_id' => $id,
                'total_orders' => $totalOrders,
                'total_spent' => $totalSpent,
                'last_order_at' => date('Y-m-d H:i:s'),
                'avg_order_value' => $totalSpent / $totalOrders,
                'retention_score' => 0,
            ]);
        }

        $this->createOrder($data, $id);
    }
    public function createCustomer($data)
    {
        $customer = Customer::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'],
            'source' => $data['source'],
            'birthday' => !empty($data['birthday']) ? $data['birthday'] : '9999-12-12',
            'address' => $data['address'],
            'suburb' => $data['suburb'],
            'state' => $data['state'],
            'postcode' => $data['postcode'],
            'note' => $data['note'],
            'phone' => $data['phone'],
            'created_by' => $this->userId,
        ]);

        // not work
        if (isset($data['tag_id'])) {
            (new CustomerService)->createTag($data['tag_id'], $customer->id);
        }
        $this->updateCustomerStat($data, $customer->id);
    }
}
