const umowaOkr=Array.from(document.querySelectorAll(".umowaOkr"));
const badaniaOkr=Array.from(document.querySelectorAll(".badaniaOkr"));
const imie=Array.from(document.querySelectorAll(".imie"));
const nazwisko=Array.from(document.querySelectorAll(".nazwisko"));
const taskValue=document.getElementById("taskValue").innerHTML;

var data = new Date();
var data1 = data.getTime();

function windowDate(){
    for(var i=0; i<umowaOkr.length; i++){

        var umowaOkr1=umowaOkr[i].innerHTML;

        if(((Date.parse(umowaOkr1)<data1) || ((((Date.parse(umowaOkr1))-data1)/(1000*60*60*24))<14)) && (taskValue=="task1")){
            document.getElementById("spanDate").innerHTML="<button id='dateCom' name='dateCom' onclick='showDateInf()'>!</button>";
   
        };
    };

    for(var j=0; j<badaniaOkr.length; j++){

        var badaniaOkr1=badaniaOkr[j].innerHTML;

        if(((Date.parse(badaniaOkr1)<data1) || ((((Date.parse(badaniaOkr1))-data1)/(1000*60*60*24))<14))  && (taskValue=="task1")){
            document.getElementById("spanDate").innerHTML="<button id='dateCom' name='dateCom' onclick='showDateInf()'>!</button>";
            
        };
    };
};


window.onload=windowDate();

function changebg(){

    if(document.getElementById("dateCom").style.color=="rgba(241, 12, 12, 0.89)") {
      document.getElementById("dateCom").style.color= "rgba(224, 231, 238, 0.87)";
      document.getElementById("dateCom").style.border= "solid black 0.1em";
    }else {
      document.getElementById("dateCom").style.color="rgba(241, 12, 12, 0.89)";
      document.getElementById("dateCom").style.border= "solid red 0.1em";
  };
  
};

const dateComExist=document.getElementById("dateCom");
if(dateComExist!=null)
{
    setInterval(changebg, 1000);
}

function showDateInf() {

    for(var i=0; i<umowaOkr.length; i++){
        
        var imie1=imie[i].innerHTML;
        var nazwisko1=nazwisko[i].innerHTML;
        var umowaOkr1=umowaOkr[i].innerHTML;

        if(Date.parse(umowaOkr1)<data1){
            alert("Minął okres umowy z: " + nazwisko1 + " " + imie1);
            
        }else if((((Date.parse(umowaOkr1))-data1)/(1000*60*60*24))<14){
            var liczbaDni1=(((Date.parse(umowaOkr1))-data1)/(1000*60*60*24));
            var liczbaDni2= liczbaDni1+0.5;
            var liczbaDni=Math.round(liczbaDni2);
            alert("Umowa z: " + nazwisko1 + " " + imie1 + " skończy się za " + liczbaDni + " dni");
        };
    };

    for(var j=0; j<badaniaOkr.length; j++){
        
        var imie2=imie[j].innerHTML;
        var nazwisko2=nazwisko[j].innerHTML;
        var badaniaOkr1=badaniaOkr[j].innerHTML;

        if(Date.parse(badaniaOkr1)<data1){
            alert("Minął okres badań lekarskich: " + nazwisko2 + " " + imie2);
            
        }else if((((Date.parse(badaniaOkr1))-data1)/(1000*60*60*24))<14){
            var liczbaDni3=(((Date.parse(badaniaOkr1))-data1)/(1000*60*60*24));
            var liczbaDni4= liczbaDni3+0.5;
            var liczbaDni5=Math.round(liczbaDni4);
            alert("Termin badań lekarskich: " + nazwisko2 + " " + imie2 + " skończy się za " + liczbaDni5 + " dni");
        };
    };


}; 

function okienkoDeleteMain(idPodm){
        var height=200;
        var width=600;

    var width1=(screen.width-width)/2;
    var height1=(screen.height-height)/2;
    window.open("deleteZastepstwo.php?zmiennaId="+idPodm, "Usun zastepstwo Main", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};