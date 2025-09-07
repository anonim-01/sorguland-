function printData() {
    var divToPrint = document.getElementById("zero-conf");
    newWin = window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}

function printTable() {
    printData();
}