<?php

namespace App\Helpers;

class ResponseHelper
{
    public static function success($msg)
    {
        return '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            ' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
    }

    public static function failed($msg)
    {
        return '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-triangle me-2"></i>
          ' . $msg . '
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
    }
}
