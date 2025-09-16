<?php

namespace App\Services;

use App\Helpers\AuthHelper;
use App\Models\Order;
use App\Models\Customer;
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
            'total_paid' => $data['amount_paid'] ?? 0,
            'scheduled_at' => $bookedAt,
            'created_by' => $this->userId,
        ]);
        $this->createOrderItems($data, $order->id);
        $this->createPayment($data, $order->id);
    }

    public function createOrderItems($data, $orderId)
    {
        $dataItems = [];
        for ($i = 0; $i < count($data['item']); $i++) {
            $price = (float) $data['price'][$i];
            $customPrice = !empty($data['custom_price'][$i]) ? (float) $data['custom_price'][$i] : null;

            $discount = 0.00;
            if (!is_null($customPrice)) {
                if ($customPrice < $price) {

                    $discount = $price - $customPrice;
                } elseif ($customPrice > $price) {

                    $discount = $price - $customPrice;
                }
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
            'amount' => $data['amount_paid'],
            'payment_method' => $data['payment_method'],
            'reference' => $data['reference'],
            'note' => $data['payment_note'],
            'created_by' => $this->userId,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function updateCustomerStat($data, $id)
    {
        $customer = Customer::find($id);
        $customer->update([
            'total_orders' => (int)($customer->total_orders ?? 0) + (int)(array_sum($data['qty']) ?? 0),
            'total_spent' => (int)($customer->total_spent ?? 0) + (int)($data['total'] ?? 0),
            'last_order_at' => date('Y-m-d H:i:s'),
        ]);
        $this->createOrder($data, $id);
    }
    public function createCustomer($data)
    {
        $customer = Customer::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'company_name' => $data['company_name'],
            'source' => $data['source'],
            'birthday' => $data['birthday'],
            'address' => $data['address'],
            'suburb' => $data['suburb'],
            'state' => $data['state'],
            'postcode' => $data['postcode'],
            'note' => $data['note'],
            'phone' => $data['phone'],
            'created_by' => $this->userId,
        ]);
        $this->updateCustomerStat($data, $customer->id);
    }
}
