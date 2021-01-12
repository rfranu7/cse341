
// VANILLA JS
// const btn = document.getElementById("colorChangeBtn");
// btn.addEventListener("click", (e) => {
//     e.preventDefault();

//     const color = document.getElementById("colorChange").value;
//     const div = document.getElementById("first-div");
//     div.style = "background-color: "+color+";";
// });

//  JQUERY
$("#colorChangeBtn").click((e) => {
    e.preventDefalt();
    const color = $("#colorChange").val();
    $("#first-div").css("background-color", color);
});

$("#visibilityChangeBtn").click((e) => {
    e.preventDefalt();
    $("#third-div").fadeToggle("slow");
});