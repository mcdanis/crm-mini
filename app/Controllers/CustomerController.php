<?php

namespace App\Controllers;

use App\Core\View;
use App\Middleware\RouteMiddleware;
use App\Service\CustomerService;
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
        $fullName = $_POST['full_name'];
        $email = $_POST['email'];
        $number = $_POST['phone'];
        $companyName = $_POST['company_name'];
        $source = $_POST['source'];
        $birthday = $_POST['birthday'];
        $tags = $_POST['tag_id'];
        $address = $_POST['address'];
        $suburb = $_POST['suburb'];
        $state = $_POST['state'];
        $postcode = $_POST['postcode'];
        $note = $_POST['note'];

        if (!ValidationHelper::alpha($fullName)) {
            echo ResponseHelper::failed('Full name should be alphabet');
            die;
        }

        if (!ValidationHelper::email($email)) {
            echo ResponseHelper::failed('Invalid Email');
            die;
        }

        if (!ValidationHelper::numeric($number)) {
            echo ResponseHelper::failed('Invalid Phone number');
            die;
        }

        if (!ValidationHelper::numeric($postcode)) {
            echo ResponseHelper::failed('Postcode should only number');
            die;
        }

        if (!ValidationHelper::alphaNum($companyName)) {
            echo ResponseHelper::failed('Company name should be alphabet or numeric');
            die;
        }

        if (!ValidationHelper::alpha($source)) {
            echo ResponseHelper::failed('Pleaes select source properly');
            die;
        }

        $customer = Customer::create([
            'full_name' => $fullName,
            'email' => $email,
            'number' => $number,
            'company_name' => $companyName,
            'source' => $source,
            'birthday' => $birthday,
            'tags' => $tags,
            'address' => $address,
            'suburb' => $suburb,
            'state' => $state,
            'postcode' => $postcode,
            'note' => $note,
        ]);

        // CustomerTag::create([
        //     'customer_id' => $customer,

        // ]);
    }

    public function index()
    {
        View::render('customers.customer_list_view', [
            'title' => 'Customer List',
        ]);
    }

    public function detail()
    {
        View::render('customers.customer_detail_view', [
            'title' => 'Detail Customer of ',
        ]);
    }
}
