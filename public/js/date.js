let d = new Date();
let datestring =
    d.getFullYear() +
    "-" +
    ("0" + (d.getMonth() + 1)).slice(-2) +
    "-" +
    ("0" + d.getDate()).slice(-2);
let dates = document.querySelectorAll(".date");
dates.forEach(date => {
    date.setAttribute("min", datestring);
});
