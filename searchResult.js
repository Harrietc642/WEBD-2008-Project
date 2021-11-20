/******w***********
    
    Assignment 4 AJAX Using Open Data
    Name: Harriet Chiu
    Date:2021-10-02
    Description: Assignment 4 - data.js

******************/
document.addEventListener("DOMContentLoaded", load);


/*
 * Handles the load event of the document.
 */
function load(){

  let submit = document.getElementById("find");
  submit.addEventListener("click", Find);
}

/*
 * Handles the find event of the document.
 */
 function Find() {

    let direction = document.getElementById("direction").value;
    //const apiurl = 'https://data.winnipeg.ca/resource/h367-iifg.json?' + `$where=lower(direction) LIKE lower('%${direction}%')` + '&$order=primary_street ASC' + '&$limit=100';

    // const encodedURL = encodeURI(apiurl);



    if(direction == "" || direction == null)
    {
      document.getElementById("blank_search").style.display = "block";
      document.getElementById("searchresult").style.display = "none";
    }
    else
    {
      document.getElementById("blank_search").style.display = "none";
      document.getElementById("searchresult").style.display = "block";

      fetch(encodedURL)
    .then(function (result) {
      return result.json(); // Promise for parsed JSON.
    })
    .then(function (data) {
      let traffics = data;

      let div = document.getElementById('searchresult');

      div.innerHTML = "";

      let table = document.createElement('table');
      table.id = "table";
      table.className = "table table-dark table-borderless";
      div.appendChild(table);

      let tbody = document.createElement('tbody');
      tbody.id = 'tbody';
      table.appendChild(tbody);

      for (let traffic of traffics) {
        console.log(traffic.direction);

        let tr2 = document.createElement('tr');
        tbody.appendChild(tr2);

        let th1 = document.createElement('td');
      
        let primary_street = traffic.primary_street;
        th1.innerHTML = primary_street;
    

        tr2.appendChild(th1);

        let td2 = document.createElement('td');
        let direction = traffic.direction;
        td2.innerHTML = direction;
        tr2.appendChild(td2);

        let td3 = document.createElement('td');
        let effect = traffic.traffic_effect;
        td3.innerHTML = effect;

        tr2.appendChild(td3);
      }

      if (traffics.length == 0) {

        let errorMessage = document.createElement('p');

        errorMessage.innerHTML = "nothing was found.";

        div.appendChild(errorMessage);
      }
    });
    }


 }

