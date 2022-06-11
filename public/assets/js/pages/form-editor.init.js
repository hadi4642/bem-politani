$(document).ready(function () {
    0 < $("textarea").length && tinymce.init({
        selector: "textarea",
        height: 300,
        plugins: 'a_tinymce_plugin',
    })
});
