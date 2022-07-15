console.log(document);

const table=document.querySelector('table');
const tableTr=Array.from(table.querySelectorAll('tr'));
const tableTdCo=Array.from(document.querySelectorAll(".umowa"));
var ulToHide = document.getElementById("ulToHide");
var ulSmallHide1 = document.getElementById("ulSmallHide1");
var ulSmallHide2 = document.getElementById("ulSmallHide2");
var imieArray = document.querySelectorAll(".btnzobaczImie"); 
var nazwiskoArray = document.querySelectorAll(".btnzobaczNazwisko");

ulToHide.style.display = "none";
ulSmallHide1.style.display = "none";
ulSmallHide2.style.display = "none";

function updateSqlAsk(){
    for (var i = 0; i < imieArray.length; i++) {
    var tableTr1=tableTr[i+1];
    tableTr1.style.display = "";
    };

    for (var i = 0; i < imieArray.length; i++) {
        var tableTr1=tableTr[i+1];
        var szukaj_pr_input1=document.getElementById("szukaj_pr_input").value;
        var szukaj_pr_input=szukaj_pr_input1.toLowerCase();
        var imieI1=imieArray[i].value;
        var imieI=imieI1.toLowerCase();
        var nazwiskoI1=nazwiskoArray[i].value;
        var nazwiskoI=nazwiskoI1.toLowerCase();

        if(szukaj_pr_input!=0){
            var isStrImie = imieI.startsWith(szukaj_pr_input);
            var isStrNazwisko = nazwiskoI.startsWith(szukaj_pr_input);
            if(isStrImie===false && isStrNazwisko===false){
                tableTr1.style.display = "none";
            };
        }else{
            break;
        }
    }
}

function updateSqlAskFirmy(){
    for (var i = 0; i < imieArray.length; i++) {
    var tableTr1=tableTr[i+1];
    tableTr1.style.display = "";
    };

    for (var i = 0; i < imieArray.length; i++) {
        var tableTr1=tableTr[i+1];
        var szukaj_pr_input1=document.getElementById("szukaj_pr_input").value;
        var szukaj_pr_input=szukaj_pr_input1.toLowerCase();
        var imieI1=imieArray[i].value;
        var imieI=imieI1.toLowerCase();

        if(szukaj_pr_input!=0){
            var isStrImie = imieI.startsWith(szukaj_pr_input);
            if(isStrImie===false){
                tableTr1.style.display = "none";
            };
        }else{
            break;
        }
    }
}

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
    if(tableTdCo[i].innerHTML=="1/2 etatu"){
        tableTdCo[i].classList.add('bgpolowa');
    }else if(tableTdCo[i].innerHTML=="3/4 etatu"){
        tableTdCo[i].classList.add('bgtrzyczw');
    }else if(tableTdCo[i].innerHTML=="pełny etat"){
        tableTdCo[i].classList.add('bgpelny');
    }else if(tableTdCo[i].innerHTML=="zlecenie"){
        tableTdCo[i].classList.add('bgzlecenie');
    }else if(tableTdCo[i].innerHTML=="B2B"){
        tableTdCo[i].classList.add('bgB2B');
    };
};

function sortTableImie() {
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

function sortTableNazwisko() {
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

function sortTableRodzUmowy() {
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

function sortTableOkrUmowy() {
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

function sortTableBadania() {
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

function sortTableBudowa() {
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
            x = rows[i].getElementsByTagName("TD")[6];
            y = rows[i + 1].getElementsByTagName("TD")[6];
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
