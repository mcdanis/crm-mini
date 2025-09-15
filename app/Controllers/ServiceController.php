<?php

namespace App\Controllers;

use App\Core\View;
use App\Helpers\ResponseHelper;
use App\Models\Service;
use App\Services\SettingService;
use App\Helpers\UtilHelper;
use Exception;
use App\Middleware\RouteMiddleware;

class ServiceController
{
    public function __construct()
    {
        RouteMiddleware::requireAuth();
    }
    public function add()
    {
        $currency = SettingService::currency();
        View::render('services.service_add_view', [
            'title' => 'Customer List',
            'currency' => $currency
        ]);
    }

    public function index()
    {
        $services = Service::all();
        View::render('services.service_list_view', [
            'title' => 'Service List',
            'services' => $services
        ]);
    }

    public function createService()
    {
        try {
            Service::create([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'default_price' => $_POST['default_price']
            ]);
            return UtilHelper::redirectWithMessage('/service/add', 'success', 'Service have been added!');
        } catch (Exception $e) {
            return UtilHelper::redirectWithMessage('/service/add', 'error', 'Service can not added, Try again later!');
        }
    }

    public function editService($id)
    {
        $service = Service::find($id);
        $currency = SettingService::currency();
        View::render('services.service_edit_view', [
            'title' => 'Edit Service',
            'service' => $service,
            'currency' => $currency,
        ]);
    }
    public function updateService($id)
    {
        try {
            Service::find($id)->update([
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'default_price' => $_POST['default_price'],
            ]);

            echo ResponseHelper::success('Service updated!');
        } catch (\Throwable $th) {
            echo ResponseHelper::success('Ops. Service can not updated. try again later!');
        }
    }

    public function deleteService($id)
    {
        try {
            Service::find($id)->delete();
            return UtilHelper::redirectWithMessage('/service/list', 'success', 'Service has been deleted!');
        } catch (Exception $e) {
            return UtilHelper::redirectWithMessage('/service/list', 'error', 'Service can not deleted!, try again later!');
        }
    }
}
