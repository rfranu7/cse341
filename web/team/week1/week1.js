
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
    console.log(e);
    const color = $("#colorChange").val();
    $("#first-div").css("background-color", color);
});

$("#visibilityChangeBtn").click((e) => {
    console.log(e);
    $("#third-div").fadeToggle("slow");
});