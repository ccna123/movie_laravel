$(document).ready(function () {

    let profile_img = document.querySelector("#profile_img");
    let formFile = document.querySelector("#formFile");
    let cancel_btn = document.querySelector("#cancel_btn");

    cancel_btn.style.display = 'none';
    formFile.addEventListener("change", (e) => {
        e.preventDefault();
        profile_img.src = URL.createObjectURL(e.target.files[0]);
        cancel_btn.style.display = 'block';
    })


    let prev_imag = document.querySelector("#profile_img").src;
    $("#cancel_btn").click(function (e) {
        e.preventDefault();
        profile_img.src = prev_imag;
        formFile.value = null;
        cancel_btn.style.display = 'none';
    });

});