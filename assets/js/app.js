// Slider Javascript
let slideIndex = 1; // Default select 1 slide
showSlides(slideIndex); // invoke showSlide func and give slideIndex

// Plus One slide if user click on forward button
// Minus One slide if user click on reverse button
// for both this purpose plusSlide take help of showSlides
function  plusSlide(n){
    showSlides(slideIndex+=n);
}

// firstly, hide all slide and display only one
// display slide one by one
function showSlides(n) {
    let i;
    let x = document.getElementsByClassName("slider-item"); // get all slider-items in x
    if (n > x.length){
        slideIndex = 1; // if slideIndex length greater then from x then slide goes to one
    }//if
    if (n < 1){
        slideIndex = x.length; // if slideIndex length less then one  then slide goes to last one
    }//if
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none"; // hide all slider-items
    }//for
    x[slideIndex-1].style.display = "block"; // display specific slide plusSlide action
}


//Testimonial Slider Javascript
let testimonialIndex = 1; // Default select 1 slide
showTestimonial(testimonialIndex); // invoke showTestimonial func and give slideIndex

// Plus One slide if user click on forward button
// Minus One slide if user click on reverse button
// for both this purpose plusSlide take help of showTestimonial
function  plusTestimonials(total_n){
    showTestimonial(testimonialIndex+=total_n);
}

// firstly, hide all slide and display only one
// display slide one by one
function showTestimonial(total_n) {
    let j;
    let test = document.getElementsByClassName("testimonial-item"); // get all testimonial-items in x
    if (total_n > test.length){
        testimonialIndex= 1; // if testimonialIndex  length greater then from x then slide goes to one
    }//if
    if (total_n < 1){
        testimonialIndex = test.length; // if testimonialIndex  length less then one  then slide goes to last one
    }//if
    for (j = 0; j < test.length; j++) {
        test[j].style.display = "none"; // hide all testimonial-items
    }//for
    test[testimonialIndex-1].style.display = "block"; // display specific slide plusTestimonials action
}