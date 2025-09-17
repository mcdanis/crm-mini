<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;
use App\Services\CustomerService;
use App\Helpers\ResponseHelper;
use App\Models\Tag;
use App\Models\Customer;
use App\Helpers\ValidationHelper;

class CustomerController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function add()
    {
        $tags = Tag::all();
        View::render('customers.customer_add_view', [
            'title' => 'Customer List',
            'tags' => $tags
        ]);
    }

    public function create()
    {
        try {
            $fullName = $_POST['full_name'];
            $email = $_POST['email'];
            $number = $_POST['phone'];
            $companyName = $_POST['company_name'];
            $source = $_POST['source'] ?? null;
            $birthday = !empty($_POST['birthday']) ? $_POST['birthday'] : null;
            $tags = $_POST['tag_id'] ?? [];
            $address = $_POST['address'];
            $suburb = $_POST['suburb'];
            $state = $_POST['state'];
            $postcode = $_POST['postcode'];
            $note = $_POST['note'];

            $errors = ValidationHelper::required($_POST, [
                'full_name',
                'source',
                'address',
                'suburb',
                'state',
            ]);

            if (!empty($errors)) {
                $msgRequired = '';
                foreach ($errors as $error) {
                    $msgRequired .= $error . '<br>';
                }
                echo ResponseHelper::jsonFailed($msgRequired);
                die;
            }
            if (!ValidationHelper::alpha($fullName)) {
                echo ResponseHelper::jsonFailed('Full name should be alphabet');
                die;
            }

            if (!ValidationHelper::email($email) && !empty($email)) {
                echo ResponseHelper::jsonFailed('Invalid Email');
                die;
            }

            if (!ValidationHelper::alphaNum($number) && !empty($number)) {
                echo ResponseHelper::jsonFailed('Invalid Phone number');
                die;
            }

            if (!ValidationHelper::numeric($postcode)) {
                echo ResponseHelper::jsonFailed('Postcode should only number');
                die;
            }

            if (!ValidationHelper::alphaNum($companyName)) {
                echo ResponseHelper::jsonFailed('Company name should be alphabet or numeric');
                die;
            }

            if (!ValidationHelper::alpha($source)) {
                echo ResponseHelper::jsonFailed('Please select source properly');
                die;
            }

            $customer = Customer::create([
                'full_name' => $fullName,
                'email' => $email,
                'company_name' => $companyName,
                'source' => $source,
                'birthday' => $birthday,
                'address' => $address,
                'suburb' => $suburb,
                'state' => $state,
                'postcode' => $postcode,
                'note' => $note,
                'phone' => $number,
            ]);

            (new CustomerService)->createTag($tags, $customer->id);
            echo ResponseHelper::jsonSuccess('A new customer have been added!');
        } catch (\Throwable $th) {
            echo ResponseHelper::jsonFailed('Ops, something went wrong!' . $th->getMessage());
        }
    }

    public function index()
    {
        $perPage = 10;
        $lastId = isset($_GET['last_id']) ? (int) $_GET['last_id'] : null;

        $query = Customer::orderBy('id', 'desc');

        if ($lastId) {
            $query->where('id', '<', $lastId);
        }

        $customers = $query->limit($perPage)->get();

        // Deteksi request AJAX
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest') {
            echo json_encode([
                'data' => $customers,
                'has_more' => $customers->count() === $perPage,
            ]);
            exit;
        }

        // Render page pertama
        View::render('customers.customer_list_view', [
            'title' => 'Customer List',
            'customers' => $customers
        ]);
    }


    public function detail($id)
    {
        $customer = Customer::find($id);
        View::render('customers.customer_detail_view', [
            'title' => 'Customer - ' . $customer->full_name,
            'customer' => $customer
        ]);
    }

    public function delete($id) {}

    public function searchForOrder()
    {
        try {
            echo json_encode(
                [
                    'status' => 'success',
                    'data' => (new CustomerService)->searchCustomerForOrder($_GET['q'])
                ]
            );
        } catch (\Throwable $th) {
            echo json_encode([
                'status' => 'error',
                'message' => $th->getMessage()
            ]);
        }
    }
}
