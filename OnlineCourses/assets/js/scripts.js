/*!
* Start Bootstrap - Modern Business v5.0.7 (https://startbootstrap.com/template-overviews/modern-business)
* Copyright 2013-2023 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-modern-business/blob/master/LICENSE)
*/

// Dodajte JavaScript za vaš projekt ovdje

document.addEventListener("DOMContentLoaded", function() {
    // Registracija forme
    const registrationForm = document.getElementById("registrationForm");
    if (registrationForm) {
        registrationForm.addEventListener("submit", function(event) {
            event.preventDefault(); 

            console.log("Submit event triggered");

            // Spremi podatke u localStorage
            const email = document.getElementById("email")?.value;
            const password = document.getElementById("password")?.value;

            if (email && password) {
                localStorage.setItem("userEmail", email);
                localStorage.setItem("userPassword", password);

                // Prikaži toastr poruku 
                if (toastr) {
                    toastr.success("Registration successful! You can now log in.", "Success");
                } else {
                    console.error("Toastr nije učitano!");
                }

                // Preusmjeri na enrollments.html nakon 2 sekunde
                setTimeout(function() {
                    console.log("Redirecting to enrollments.html...");
                    window.location.href = "enrollments.html";
                }, 2000); 
            } else {
                console.error("Email ili password polje nije pronađeno!");
            }
        });
    } else {
        console.warn("Forma za registraciju nije pronađena!");
    }

    // Login forma
    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function(event) {
            event.preventDefault();

            const loginEmail = document.getElementById("loginEmail")?.value;
            const loginPassword = document.getElementById("loginPassword")?.value;

            if (loginEmail && loginPassword) {
                // Ovde možete dodati logiku za proveru login podataka

                // Prikaži toastr poruku o uspešnom loginu
                if (toastr) {
                    toastr.success("Login successful! Welcome back.", "Success");
                } else {
                    console.error("Toastr nije učitano!");
                }

                // Preusmjeri na home stranicu 
                setTimeout(function() {
                    console.log("Redirecting after login...");
                    window.location.href = "home.html"; 
                }, 2000);
            } else {
                console.error("Login email ili password polje nije pronađeno!");
            }
        });
    } else {
        console.warn("Forma za login nije pronađena!");
    }

    // Review forma
    const reviewForm = document.getElementById('reviewForm');
    if (reviewForm) {
        reviewForm.addEventListener('submit', function(event) {
            event.preventDefault(); 

            // Prikaži Bootstrap toast
            const reviewToastElement = document.getElementById('reviewToast');
            if (reviewToastElement) {
                const toast = new bootstrap.Toast(reviewToastElement);
                toast.show();

                // Sakrij toast nakon 3 sekunde
                setTimeout(function() {
                    toast.hide();
                }, 3000); 
            } else {
                console.error("Toast element nije pronađen!");
            }

            // Resetiraj formu
            reviewForm.reset();
        });
    } else {
        console.warn("Forma za recenziju nije pronađena!");
    }
});

$(document).on('spapp:afterLoad', function () {
    // Ponovno inicijalizuj sve dropdown menije nakon što se sadržaj učita
    $('[data-bs-toggle="dropdown"]').each(function () {
        new bootstrap.Dropdown(this);
    });
});

$(document).ready(function () {
    // Ponovno inicijalizujte sve dropdown menije
    $('[data-bs-toggle="dropdown"]').each(function () {
        new bootstrap.Dropdown(this);
    });
});

// Handle Review Form Submission
$(document).on("submit", "#reviewForm", function (event) {
    event.preventDefault(); // Prevent actual form submission

    var name = $("#reviewName").val().trim();
    var rating = $("#reviewRating").val();
    var comment = $("#reviewComment").val().trim();

    if (name === "" || rating === null || comment === "") {
        toastr.error("Please fill in all fields.", "Submission Failed");
        return;
    }

    // Simulate form submission
    setTimeout(function () {
        toastr.success("Your review has been submitted successfully!", "Success");
        $("#reviewForm")[0].reset(); // Reset form fields
    }, 500);
});
