/**
 * Handle form submission via AJAX
 * @param {string} formId - ID dari form
 * @param {Object} options - konfigurasi tambahan
 *   - resultId: ID elemen untuk tampilkan hasil
 *   - onSuccess: callback ketika sukses
 *   - onFinally: callback ketika selesai
 *   - closeModalId: ID modal yang perlu ditutup setelah sukses
 *   - refreshFormId: ID form lain yang perlu di-trigger submit ulang
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
