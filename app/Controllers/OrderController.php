<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;
use App\Models\Tag;
use App\Models\Service;
use App\Helpers\ResponseHelper;
use App\Helpers\ValidationHelper;
use App\Services\OrderService;
use Illuminate\Database\Capsule\Manager as DB;

class OrderController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function add()
    {
        $tags = Tag::all();
        $services = Service::all();
        View::render('orders.order_add_view', [
            'title' => 'Customer List',
            'tags' => $tags,
            'services' => $services
        ]);
    }

    public function index()
    {
        View::render('orders.order_list_view', [
            'title' => 'Customer List',
        ]);
    }

    public function create()
    {
        try {
            DB::beginTransaction();

            $errors = [];

            // Ambil semua request
            $customerType = isset($_POST['customer_type']); // true jika checkbox dicentang
            $fullName = $_POST['full_name'] ?? null;
            $email = $_POST['email'] ?? null;
            $phone = $_POST['phone'] ?? null;
            $companyName = $_POST['company_name'] ?? null;
            $source = $_POST['source'] ?? null;
            $birthday = $_POST['birthday'] ?? null;
            $tags = $_POST['tag_id'] ?? [];
            $address = $_POST['address'] ?? null;
            $suburb = $_POST['suburb'] ?? null;
            $state = $_POST['state'] ?? null;
            $postcode = $_POST['postcode'] ?? null;
            $note = $_POST['note'] ?? null;
            $selectedCustomer = $_POST['selected_customer'] ?? null;
            $item = $_POST['item'] ?? [];

            $orderStatus = $_POST['order_status'] ?? null;
            $bookedAt = $_POST['booked_at'] ?? null;

            $amountPaid = $_POST['amount_paid'] ?? null;
            $paymentMethod = $_POST['payment_method'] ?? null;
            $reference = $_POST['reference'] ?? null;
            $paymentNote = $_POST['payment_note'] ?? null;

            // --------------------------------------------------
            // 0. Cek agar tidak kosong total
            // --------------------------------------------------
            if ($customerType) {
                if (empty($fullName) && empty($phone) && empty($email)) {
                    $errors[] = 'Please select existing customer or choose new customer';
                }
            }

            // --------------------------------------------------
            // 1. Validasi Customer Info (jika checkbox dicentang)
            // --------------------------------------------------
            if ($customerType) {
                $requiredErrors = ValidationHelper::required($_POST, [
                    'full_name',
                    'source',
                    'address',
                    'suburb',
                    'state',
                    'postcode',
                ]);
                $errors = array_merge($errors, $requiredErrors);
            }

            // --------------------------------------------------
            // 2. Validasi per field (jika ada isinya)
            // --------------------------------------------------
            if (!empty($fullName) && !ValidationHelper::alpha($fullName)) {
                $errors[] = 'Full name should contain only alphabet';
            }

            if (!empty($email) && !ValidationHelper::email($email)) {
                $errors[] = 'Invalid Email format';
            }

            if (!empty($phone) && !ValidationHelper::alphaNum($phone)) {
                $errors[] = 'Invalid Phone number';
            }

            if (!empty($companyName) && !ValidationHelper::alphaNum($companyName)) {
                $errors[] = 'Company name should be alphabet or numeric';
            }

            if (!empty($postcode) && !ValidationHelper::numeric($postcode)) {
                $errors[] = 'Postcode should only contain numbers';
            }

            if (!empty($source) && !ValidationHelper::alpha($source)) {
                $errors[] = 'Invalid source selected';
            }

            // --------------------------------------------------
            // 3. Validasi Order Status (selalu wajib diisi)
            // --------------------------------------------------
            if (empty($orderStatus)) {
                $errors[] = 'Order status is required';
            }

            if ($orderStatus === 'booked' && empty($bookedAt)) {
                $errors[] = 'Booked At is required when status is booked';
            }

            // --------------------------------------------------
            // 4. Validasi Payment (boleh kosong semua)
            // --------------------------------------------------
            if (!empty($amountPaid) && !ValidationHelper::numeric($amountPaid)) {
                $errors[] = 'Amount paid should be numeric';
            }
            if (!empty($paymentMethod) && !ValidationHelper::alpha($paymentMethod)) {
                $errors[] = 'Invalid payment method';
            }
            if (!empty($reference) && !ValidationHelper::alphaNum($reference)) {
                $errors[] = 'Invalid payment reference';
            }

            // --------------------------------------------------
            // 5. validate item
            // --------------------------------------------------
            if (count($item) < 1) {
                $errors[] = 'Please select service';
            }

            // --------------------------------------------------
            // Return error jika ada
            // --------------------------------------------------
            if (!empty($errors)) {
                $msg = implode('<br>', $errors);
                echo ResponseHelper::jsonFailed($msg);
                die;
            }

            $result = (new OrderService)->proccessOrder($_POST);
            DB::commit();
            echo ResponseHelper::jsonSuccess($result);
        } catch (\Throwable $th) {
            DB::rollBack();
            echo ResponseHelper::jsonFailed('Ops, something went wrong! ' . $th->getMessage());
        }
    }
}
