<?php

namespace App\Helpers;

class HtmlGenerateHelper
{
    public static function renderUserRow($user)
    {
        $badge = 'role-user';
        $roleTitle = 'User';

        if ($user->role === 'admin') {
            $badge = 'role-admin';
            $roleTitle = 'Admin';
        }

        $statusBadge = $user->is_active == 1
            ? '<span class="badge bg-success">Active</span>'
            : '<span class="badge bg-danger">Inactive</span>';

        $actionBtn = '';
        if ($user->is_active == 1) {

            $actionBtn = '
                <a onclick="ajaxGet(`/api/user/0/' . $user->id . '`, `Are you sure to deactivate this user?`)" 
                class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-lock"></i>
                </a>';
        } else {
            $actionBtn = '
                <a onclick="ajaxGet(`/api/user/1/' . $user->id . '`, `Are you sure to activate this user?`)" 
                class="btn btn-sm btn-outline-success">
                    <i class="fas fa-unlock"></i>
                </a>';
        }

        return '
    <tr>
        <td>
            <div class="d-flex align-items-center">
                <div>
                    <strong>' . e($user->full_name) . '</strong><br />
                </div>
            </div>
        </td>
        <td>' . e($user->email) . '</td>
        <td>
            <span class="role-badge ' . $badge . '">
                ' . $roleTitle . '
            </span>
        </td>
        <td>' . $statusBadge . '</td>
        <td>
            <div class="btn-group" role="group">
                <button
                    class="btn btn-sm btn-outline-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#editUserModal">
                    <i class="fas fa-edit"></i>
                </button> 
                ' . $actionBtn . '
            </div>
        </td>
    </tr>';
    }
}
