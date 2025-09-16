/**
 * Handle form submission via AJAX
 * @param {string} formId - ID dari form
 * @param {Object} options - konfigurasi tambahan
 *   - resultId: ID elemen untuk tampilkan hasil
 *   - onSuccess: callback ketika sukses
 *   - onFinally: callback ketika selesai
 *   - closeModalId: ID modal yang perlu ditutup setelah sukses
 *   - refreshFormId: ID form lain yang perlu di-trigger submit ulang
 *   - resetForm: boolean, reset form setelah submit sukses
 *   - scrollTo: "top" | "bottom" | string (id elemen) → scroll otomatis
 */
function handleAjaxForm(formId, options = {}) {
  const form = document.getElementById(formId);

  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const {
      resultId,
      onSuccess,
      onFinally,
      closeModalId,
      refreshFormId,
      resetForm,
      scrollTo,
    } = options;

    const result = resultId ? document.getElementById(resultId) : null;
    if (result) result.innerHTML = "";

    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.disabled = true;

    fetch(form.action, {
      method: form.method,
      body: formData,
    })
      .then((response) => response.text())
      .then((data) => {
        if (result) result.innerHTML = data;
        if (onSuccess) onSuccess(data);

        // Reset form jika diminta
        if (resetForm) form.reset();

        // Scroll otomatis
        if (scrollTo) {
          if (scrollTo === "top") {
            window.scrollTo({ top: 0, behavior: "smooth" });
          } else if (scrollTo === "bottom") {
            window.scrollTo({
              top: document.body.scrollHeight,
              behavior: "smooth",
            });
          } else {
            const targetEl = document.getElementById(scrollTo);
            if (targetEl) {
              targetEl.scrollIntoView({ behavior: "smooth" });
            }
          }
        }
      })
      .catch((error) => console.error("Error:", error))
      .finally(() => {
        // Tutup modal jika ada
        if (closeModalId) {
          const modalElement = document.getElementById(closeModalId);
          if (modalElement) {
            const modalInstance =
              bootstrap.Modal.getInstance(modalElement) ||
              new bootstrap.Modal(modalElement);
            modalInstance.hide();
          }
        }

        // Refresh form lain jika ada
        if (refreshFormId) {
          const refreshForm = document.getElementById(refreshFormId);
          if (refreshForm) {
            refreshForm.dispatchEvent(
              new Event("submit", { cancelable: true, bubbles: true })
            );
          }
        }

        if (submitBtn) submitBtn.disabled = false;
        if (onFinally) onFinally();
      });
  });
}

function handleAjaxFormJson(formId, options = {}) {
  const form = document.getElementById(formId);
  if (!form) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const {
      resultId,
      onSuccess,
      onError,
      onFinally,
      closeModalId,
      refreshFormId,
      resetForm,
      scrollTo,
    } = options;

    const result = resultId ? document.getElementById(resultId) : null;
    if (result) result.innerHTML = "";

    const formData = new FormData(form);
    const submitBtn = form.querySelector('button[type="submit"]');
    if (submitBtn) submitBtn.disabled = true;

    let lastStatus = null;

    fetch(form.action, {
      method: form.method,
      body: formData,
    })
      .then((response) => response.json()) // ✅ backend harus return JSON
      .then((data) => {
        lastStatus = data.status || null;

        if (result && data.message) {
          result.innerHTML = data.message; // ✅ HTML langsung dari backend
        }

        if (data.status === "success") {
          if (onSuccess) onSuccess(data);

          if (resetForm) {
            // delay supaya DOM update dulu
            setTimeout(() => {
              form.reset();

              // clear select/textarea secara eksplisit
              form.querySelectorAll("select").forEach((s) => (s.value = ""));
              form.querySelectorAll("textarea").forEach((t) => (t.value = ""));

              // support select2 kalau dipakai
              if (window.jQuery) {
                $(form).find("select").val(null).trigger("change");
              }
            }, 100);
          }
        } else if (data.status === "error") {
          if (onError) onError(data);
        }

        // Scroll otomatis
        if (scrollTo) {
          if (scrollTo === "top") {
            window.scrollTo({ top: 0, behavior: "smooth" });
          } else if (scrollTo === "bottom") {
            window.scrollTo({
              top: document.body.scrollHeight,
              behavior: "smooth",
            });
          } else {
            const targetEl = document.getElementById(scrollTo);
            if (targetEl) {
              targetEl.scrollIntoView({ behavior: "smooth" });
            }
          }
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        if (result) {
          result.innerHTML =
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
            '<i class="fas fa-exclamation-circle me-2"></i>' +
            "Unexpected error occurred." +
            '<button type="button" class="btn-close" data-bs-dismiss="alert"></button>' +
            "</div>";
        }
        if (onError) onError(error);
      })
      .finally(() => {
        // Tutup modal jika ada
        if (closeModalId) {
          const modalElement = document.getElementById(closeModalId);
          if (modalElement) {
            const modalInstance =
              bootstrap.Modal.getInstance(modalElement) ||
              new bootstrap.Modal(modalElement);
            modalInstance.hide();
          }
        }

        // Refresh form lain jika ada
        if (refreshFormId) {
          const refreshForm = document.getElementById(refreshFormId);
          if (refreshForm) {
            refreshForm.dispatchEvent(
              new Event("submit", { cancelable: true, bubbles: true })
            );
          }
        }

        if (submitBtn) submitBtn.disabled = false;
        if (onFinally) onFinally();
      });
  });
}

/**
 * Simple GET request dengan konfirmasi
 * @param {string} url
 * @param {string} msg
 * @param {string} resultId - ID elemen untuk tampilkan hasil
 * @param {string} refreshFormId - ID form untuk refresh data
 */
function ajaxGet(url, msg, resultId = null, refreshFormId = null) {
  const confirmMessage = confirm(msg);
  if (!confirmMessage) return;

  fetch(url, { method: "GET" })
    .then((response) => response.text())
    .then((data) => {
      if (resultId) {
        const result = document.getElementById(resultId);
        if (result) result.innerHTML = data;
      }
      if (refreshFormId) {
        const refreshForm = document.getElementById(refreshFormId);
        if (refreshForm) {
          refreshForm.dispatchEvent(
            new Event("submit", { cancelable: true, bubbles: true })
          );
        }
      }
    })
    .catch((error) => console.error("Error:", error));
}

function ajaxGetJson(url, msg = null, resultId = null, refreshFormId = null) {
  if (msg) {
    const confirmMessage = confirm(msg);
    if (!confirmMessage) return;
  }

  fetch(url, { method: "GET" })
    .then((response) => response.json())
    .then((data) => {
      if (resultId) {
        const result = document.getElementById(resultId);
        if (result) result.innerHTML = data.data;
        if (window.initCustomerRadios) window.initCustomerRadios(resultId);
      }
      if (refreshFormId) {
        const refreshForm = document.getElementById(refreshFormId);
        if (refreshForm) {
          refreshForm.dispatchEvent(
            new Event("submit", { cancelable: true, bubbles: true })
          );
        }
      }
    })
    .catch((error) => console.error("Error:", error));
}
