$(document).on("render", function () {
    const rangeSelectors = document.querySelectorAll(".form-range-group .form-range");
    const rangeInputs = document.querySelectorAll(".form-range-group .form-control");

    rangeSelectors.forEach(rangeSelector => {
        const rangeInput = rangeSelector.nextElementSibling;

        rangeSelector.addEventListener("input", function () {
            rangeInput.value = this.value;
        });
    });

    rangeInputs.forEach(rangeInput => {
        const rangeSelector = rangeInput.previousElementSibling;

        rangeInput.addEventListener("input", function () {
            rangeSelector.value = this.value;
        });
    })
});
