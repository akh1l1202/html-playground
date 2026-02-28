let technicalEvents = ["Code Challenges","DSA Practice Sessions","Circuit Design","Arduino Workshops"];
let culturalEvents = ["Dance Club","Drama Club","Music Club"];
let featuredEvents = ["Arduino Workshops","Dance Club"];

let list = document.getElementById("clubEvents");

function displayEvents(eventArray) {
    for (let i=0; i<eventArray.length; i++) {
        let li = document.createElement("li");
        li.textContent = eventArray[i];

        if (featuredEvents.includes(eventArray[i])) {
            li.style.color = "green";
            li.style.fontWeight = "bold";
            li.textContent += " (Featured)";
        }

        list.appendChild(li);
    }
}
const countEvents = (array1, array2) => {
    return array1.length+array2.length;
};

displayEvents(technicalEvents);
displayEvents(culturalEvents);
let total = countEvents(technicalEvents, culturalEvents);
let totalPara = document.createElement("p");
totalPara.textContent = "Total Events: " + total;
totalPara.style.fontWeight = "bold";
list.after(totalPara);