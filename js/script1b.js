console.log(document);

const table=document.querySelector('table');
const tableTr=Array.from(table.querySelectorAll('tr'));
const tableTdCo=Array.from(document.querySelectorAll(".co"));
const table2a=document.querySelectorAll('table');
const table2b=Array.from(table2a);
const table2=table2b[1];
const switchBtnA=document.querySelectorAll('.switchBtn');
const switchBtnB=Array.from(switchBtnA);
const switchBtn1=switchBtnB[0];
const switchBtn2=switchBtnB[1];
const tableTr2=Array.from(table2.querySelectorAll('tr'));
const hidden1=Array.from(document.querySelectorAll('.hidden1'));
const hidden2=Array.from(document.querySelectorAll('.hidden2'));

for(var i=0; i<tableTr.length; i++){
    if(i%2==0){
        tableTr[i].classList.add('tabbgcolordark');
    }else{
        tableTr[i].classList.add('tabbgcolorlight');
    };
};

for(var i=0; i<tableTr2.length; i++){
    if(i%2==0){
        tableTr2[i].classList.add('tabbgcolordark');
    }else{
        tableTr2[i].classList.add('tabbgcolorlight');
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

function sortTableData2() {
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

function sortTableData2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

};

function sortTableData22() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

};

function sortTableZakogo2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

};

function sortTableKto2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

};

function sortTableCo2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

};

function sortTableGdzie2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

  
};

function sortTableZuraw2() {
    var table, cols, switching, i, x, y, shouldSwitch;
    table = document.getElementById("sortable2");
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

 
};


function show1(){
    hidden1.forEach(Element => {
        Element.classList.remove('hidden');
    });
    hidden2 .forEach(Element => {
        Element.classList.add('hidden');
    });
    switchBtn1.classList.remove('switchBtnHidden');
    switchBtn1.classList.add('switchBtnActive');
    switchBtn2.classList.remove('switchBtnActive');
    switchBtn2.classList.add('switchBtnHidden');
};

function show2(){
    hidden2.forEach(Element => {
        Element.classList.remove('hidden');
    });
    hidden1.forEach(Element=> {
        Element.classList.add('hidden');
    });
    switchBtn1.classList.remove('switchBtnActive');
    switchBtn1.classList.add('switchBtnHidden');
    switchBtn2.classList.remove('switchBtnHidden');
    switchBtn2.classList.add('switchBtnActive');
};


function okienkoDeletePrac(idPodm, idPr){
    var height=200;
    var width=600;

    var width1=(screen.width-width)/2;
    var height1=(screen.height-height)/2;
    window.open("deleteZastepstwoPrac.php?zmiennaId="+idPodm+"&zmiennaId2="+idPr, "Usuń", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};

function okienkoDeleteFirm(idPodm, idPr){
    var height=200;
    var width=600;

    var width1=(screen.width-width)/2;
    var height1=(screen.height-height)/2;
    window.open("deleteZastepstwoFirmy1.php?zmiennaId="+idPodm+"&zmiennaId2="+idPr, "Usuń", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};
function okienkoDeleteRand(idPodm, idPr){
    var height=200;
    var width=600;

    var width1=(screen.width-width)/2;
    var height1=(screen.height-height)/2;
    window.open("deleteZastepstwoPr1.php?zmiennaId="+idPodm+"&zmiennaId2="+idPr, "Usuń", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};