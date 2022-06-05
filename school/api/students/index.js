async function loadStudents( url, table ){
const tableHead = table.querySelector("thead");
const tableBody = table.querySelector("tbody");

const response = await fetch( url );// 1st get data from api then run next command
const data = await response.json();

console.log(data);

for (const {fname} of data) {
    // create a row element
    const re = document.createElement("tr");
    // for every row create a cell of data
    //for (const cell of row) {
        const ce = document.createElement("td");
        // assign data to the cell
        ce.textContent = fname;
        console.log(fname);
        //attach the cell to the row element
        re.appendChild(ce);
        
    //}// inner for
    // attach the row to the table
    tableBody.appendChild(re);
    
}// outer for loop

}  

// loadStudents( './read_all.php', document.querySelector("table") );