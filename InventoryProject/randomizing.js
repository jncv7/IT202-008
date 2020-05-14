// we are coding for a way to get 5 items where there is rarity involved
/* *
 * you have a 65 percent chance to get a Common drop
 * you have a 20 percent chance to get a rare drop
 * you have a 10 percent chance to get a super rare drop
 * you have a 4 percent chance to get a ultra rare drop
 * you have a 1 percent chance to get a SSS rare drop
 * */

// list the chance variables out of 1000 here

var common, rare, superRare, ultraRare, SSSRare, modifier;
common = 650;
rare = 850;
superRare = 950;
ultraRare = 990;
SSSRare = 1000;





// create a random number func
// NOTE: this function will have different min and max dependent on multipliers that the user gains
function randomNumbers() {
    var min = 0;
    var max = 1000;
    var x = Math.floor(Math.random() * (max - min) + min);

    if (x <= 650) {
        console.log("You got a commom rare drop");
        document.getElementById("NumGot").innerHTML = "Common Drop";

    } else if (x <= 850) {
        console.log("you got a rare drop");
        document.getElementById("NumGot").innerHTML = "Rare Drop";

    } else if (x <= 950) {
        console.log("You got a SuperRare Drop");
        document.getElementById("NumGot").innerHTML = "Super Rare Drop";

    } else if (x <= ultraRare) {
        console.log("You got a ultraR drop");
        document.getElementById("NumGot").innerHTML = "Ultra Rare Drop";
    } else {
        console.log("You got a SSSR DROP");
        document.getElementById("NumGot").innerHTML = "TOP TIER DROP";

    }


}

//testing 
//var x = randomNumbers(0, 1000);


//make the percentages
/*
if (x <= 650) {
    console.log("You got a commom rare drop");
    // document.getElementById("NumGot").innerHTML = "Common Drop";

} else if (x <= 850) {
    console.log("you got a rare drop");
    //  document.getElementById("NumGot").innerHTML = "Rare Drop";

} else if (x <= 950) {
    console.log("You got a SuperRare Drop");
    //   document.getElementById("NumGot").innerHTML = "Super Rare Drop";

} else if (x <= ultraRare) {
    console.log("You got a ultraR drop");
    //   document.getElementById("NumGot").innerHTML = "Ultra Rare Drop";
} else {
    console.log("You got a SSSR DROP");
    //   document.getElementById("NumGot").innerHTML = "TOP TIER DROP";

}
*/