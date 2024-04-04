//show
const loadingEl = document.createElement("div")
document.body.prepend(loadingEl)
loadingEl.classList.add("page-loader")
loadingEl.classList.add("flex-column")
loadingEl.classList.add("bg-dark")
loadingEl.classList.add("bg-opacity-25")
loadingEl.innerHTML =
  `<span class="spinner-border text-primary" role="status">` +
  `</span>` +
  `<span class="text-gray-800 fs-6 fw-semibold mt-5">` +
  `Loading...` +
  `</span>`
KTApp.showPageLoading()

//hidden
KTApp.hidePageLoading();
loadingEl.remove();