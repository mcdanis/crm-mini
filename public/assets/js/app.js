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
handleAjaxFormJson("addCustomer", {
  resultId: "result",
  resetForm: true,
  scrollTo: "top",
});

// create order
handleAjaxFormJson("addOrder", {
  resultId: "result",
  resetForm: true,
  scrollTo: "top",
});

function deleteUser(url, msg) {
  ajaxGet(url, msg, "result", "filterUsers");
}

// search customer in order page
function searchCustomer(e) {
  ajaxGetJson(
    "/api/customer/search-for-order?q=" + e.target.value,
    null,
    "resultSearchedCustomer"
  );
  const container = document.getElementById("customers-wrap"); // container statis Anda
  container.innerHTML = html;
  // panggil helper supaya jika ada radio yang sudah checked di fragment, detailnya terbuka
  window.showCheckedIn(container);
}

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function () {
  $(".multiselect").select2();

  $("#orderStatus").change(function () {
    var selectedValue = $(this).val();
    $("#booked-at").addClass("d-none");
    if (selectedValue == "booked") {
      $("#booked-at").removeClass("d-none");
    }
  });
});

// customer-type - add order page
$("#customer-type").on("change", function () {
  if ($(this).prop("checked")) {
    $("#customer-type-section").hide();
    $("#userInfoAccordion").show();
  } else {
    $("#userInfoAccordion").hide();
    $("#customer-type-section").show();
  }
});

// search order
(function () {
  function hideAllDetails(container) {
    const all = (container || document).querySelectorAll(".customer-detail");
    all.forEach((d) => {
      d.classList.add("d-none");
    });
  }

  function showDetailFor(radio) {
    if (!radio) return;
    const container = radio.closest(".customer-item");
    if (!container) return;

    // sembunyikan semua detail di parent container
    hideAllDetails(container.parentElement);

    // tampilkan detail di dalam item ini
    const detail = container.querySelector(".customer-detail");
    if (detail) {
      detail.classList.remove("d-none");
    }
  }

  // Event delegation: berlaku untuk radio yang ditambahkan via AJAX
  document.addEventListener("change", function (e) {
    if (e.target.matches(".customer-radio")) {
      showDetailFor(e.target);
    }
  });

  // optional: fungsi untuk dipanggil setelah ajaxGetJson inject html
  window.initCustomerRadios = function (resultId) {
    const result = document.getElementById(resultId);
    if (!result) return;
    const checked = result.querySelector(".customer-radio:checked");
    if (checked) showDetailFor(checked);
  };
})();

$(document).on("change", "#serviceSelect", function () {
  const price = $(this).find(":selected").data("price");
  $("#priceInput").val(price);

  // update total kalau qty sudah diisi
  const qty = parseFloat($("#qtyInput").val()) || 0;
  $("#totalInput").val((qty * price).toFixed(2));
});

$(document).on("input", "#qtyInput, #priceInput", function () {
  const qty = parseFloat($("#qtyInput").val()) || 0;
  const price = parseFloat($("#priceInput").val()) || 0;
  $("#totalInput").val((qty * price).toFixed(2));
});
