handleAjaxForm("updateService", {
    resultId: "result",
});
// Update setting form
handleAjaxForm("updateSetting", {
    resultId: "result",
});

// Add user form
handleAjaxForm("addUser", {
    resultId: "result",
    closeModalId: "addUserModal",
    refreshFormId: "filterUsers",
});

// Filter users form
handleAjaxForm("filterUsers", {
    resultId: "userDatas",
});

// Update user form
handleAjaxForm("updateUser", {
    resultId: "result",
    closeModalId: "editUserModal",
    refreshFormId: "filterUsers",
});

// create customer form
handleAjaxForm("addCustomer", {
    resultId: "result",
});

function deleteUser(url, msg) {
    ajaxGet(url, msg, "result", "filterUsers");
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
    $('.multiselect').select2();
});