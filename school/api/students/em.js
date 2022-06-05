async function edit(){
    const tr = document.getElementById("ass" );
    // clear the initial row 
    // tr.innerHTML = " <tr></tr> ";
    // create new staff there
    
    const response = await fetch("http://localhost/frontend/school/api/students/one_sub.php?reg=1&cname=senior%20one&sub=english");
    const data = await response.json();
    const test =  data[0]['test'] ;// get value for test marks
    const exam =  data[0]['exam'] ;// get value for test marks
    const total =  data[0]['total'] ;// get value for test marks
  
    console.log( test );// get value for test marks


    tr.innerHTML = ` <tr>

     <td> <input type="text" size="2" value=${test}> </td>
     <td> <input type="text" size="2" value=${exam}> </td>
     <td> <input type="text" size="2" value=${total}> </td>
     <td> <button type="submit" onclick="location.href = 'post.html';" >save marks</button></td>
    </tr> `;

    

}