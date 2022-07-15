console.log(document);

const table=document.querySelector('table');
const tableTr=Array.from(table.querySelectorAll('tr'));
const tableTdCo=Array.from(document.querySelectorAll(".co"));
var ulToHide = document.getElementById("ulToHide");
var ulSmallHide1 = document.getElementById("ulSmallHide1");
var ulSmallHide2 = document.getElementById("ulSmallHide2");

ulToHide.style.display = "none";
ulSmallHide1.style.display = "none";
ulSmallHide2.style.display = "none";

function showNavig2(){
    if (ulToHide.style.display === "none") {
        ulToHide.style.display = "block";
    } else {
        ulToHide.style.display = "none";
    }
};

function showNavigSmall1(){
    if (ulSmallHide1.style.display === "none") {
        ulSmallHide1.style.display = "block";
    } else {
        ulSmallHide1.style.display = "none";
    }
};

function showNavigSmall2(){
    if (ulSmallHide2.style.display === "none") {
        ulSmallHide2.style.display = "block";
    } else {
        ulSmallHide2.style.display = "none";
    }
};

for(var i=0; i<tableTr.length; i++){
    if(i%2==0){
        tableTr[i].classList.add('tabbgcolordark');
    }else{
        tableTr[i].classList.add('tabbgcolorlight');
    };
};


for(var i=0; i<tableTdCo.length; i++){
    if(tableTdCo[i].innerHTML=="Z_nasze"){
        tableTdCo[i].classList.add('bgznasze');
    }else if(tableTdCo[i].innerHTML=="Z_inne"){
        tableTdCo[i].classList.add('bgzinne');
    }else if(tableTdCo[i].innerHTML=="zaliczka"){
        tableTdCo[i].classList.add('bgzalicza');
    }else if(tableTdCo[i].innerHTML=="wolne"){
        tableTdCo[i].classList.add('bgurlop');
    };
};


function sortTableData() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableZakogo() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[1];
            y = rows[i + 1].getElementsByTagName("TD")[1];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableKto() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[2];
            y = rows[i + 1].getElementsByTagName("TD")[2];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableCo() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[3];
            y = rows[i + 1].getElementsByTagName("TD")[3];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableGdzie() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[4];
            y = rows[i + 1].getElementsByTagName("TD")[4];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableZuraw() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[5];
            y = rows[i + 1].getElementsByTagName("TD")[5];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};

function sortTableKto7() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable");
    switching = true;
    /* Make a loop that will continue until
    no switching has been done: */
    while (switching) {
        switching = false;
   
        cols = table.cols;
        rows = table.rows;
       
        for (i = 1; i < (rows.length - 1); i++) {
            // Start by saying there should be no switching:
            shouldSwitch = false;
            /* Get the two elements you want to compare,
            one from current row and one from the next: */
            x = rows[i].getElementsByTagName("TD")[7];
            y = rows[i + 1].getElementsByTagName("TD")[7];
            // Check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            // If so, mark as a switch and break the loop:
            shouldSwitch = true;
            break;
            }
        }
        if (shouldSwitch) {
            /* If a switch has been marked, make the switch
            and mark that a switch has been done: */
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    
  };

  for(var k=0; k<tableTr.length; k++){
    if(k%2==0){
        tableTr[k].classList.add('tabbgcolordark');
    }else{
        tableTr[k].classList.add('tabbgcolorlight');
    };
};
};
