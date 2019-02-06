var joinusBtn = document.querySelector("#joinus-btn");

console.log(joinusBtn)

joinusBtn.addEventListener("click",function(e) {
    console.log("hit")
    document.querySelector("#login-form").classList.add("hidden");
    document.querySelector("#joinus-form").classList.remove("hidden");
})