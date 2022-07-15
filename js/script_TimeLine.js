console.log(document);

const divTimeLine=document.getElementById('Timeline');
const tableLine=document.querySelector('table');
const tableTrLine=Array.from(table.querySelectorAll('tr'));
var k=0;
var currentDate=new Date();
var onlyYear=currentDate.getFullYear();
const divStyczen=document.getElementById('divStyczen');
let divLuty=document.getElementById('divLuty');

//ROK PRZESTEPNY
if(onlyYear%4===0){
    divStyczen.innerHTML+="<style>#divLuty{width:290px;}</style>";
}else{
    divStyczen.innerHTML+="<style>#divLuty{width:280px;}</style>";
};


 // OKREŚLNIE PIERWSZEJ NIEDZIELI STYCZNIA B.R. 
        var YearAndMonth=new Date(onlyYear, 0, 1);
        var dzientygodnia = YearAndMonth.getDay();
        if(dzientygodnia===0){
            var pierwszaNiedzRoku = YearAndMonth;
        }else{
            var YearAndMonth=new Date(onlyYear, 0, 2);
            var dzientygodnia = YearAndMonth.getDay();
            if(dzientygodnia===0){
                var pierwszaNiedzRoku = YearAndMonth;
            }else{
                var YearAndMonth=new Date(onlyYear, 0, 3);
                var dzientygodnia = YearAndMonth.getDay();
                if(dzientygodnia===0){
                    var pierwszaNiedzRoku = YearAndMonth;
                }else{
                    var YearAndMonth=new Date(onlyYear, 0, 4);
                    var dzientygodnia = YearAndMonth.getDay();
                    if(dzientygodnia===0){
                        var pierwszaNiedzRoku = YearAndMonth;
                    }else{
                        var YearAndMonth=new Date(onlyYear, 0, 5);
                        var dzientygodnia = YearAndMonth.getDay();
                        if(dzientygodnia===0){
                            var pierwszaNiedzRoku = YearAndMonth;
                        }else{
                            var YearAndMonth=new Date(onlyYear, 0, 6);
                            var dzientygodnia = YearAndMonth.getDay();
                            if(dzientygodnia===0){
                                var pierwszaNiedzRoku = YearAndMonth;
                            }else{
                                var YearAndMonth=new Date(onlyYear, 0, 7);
                                var dzientygodnia = YearAndMonth.getDay();
                                if(dzientygodnia===0){
                                    var pierwszaNiedzRoku = YearAndMonth;
                                }
                            }
                        }
                    }
                }
            }
        }
        var marginToMove=pierwszaNiedzRoku.getDate();

// RYSOWANIE PODZIALEK WYKRESU
function makePodzialki(){
    var leftMargin=(marginToMove)*10;
    for(var a=0; a<52; a++){
        divStyczen.innerHTML+="<style>#podzialka"+[a]+"{margin-left:"+(leftMargin-((a+0.01)*0.1))+"px;}</style><div class='Podzialki' id='podzialka"+[a]+"'></div>";
        leftMargin=leftMargin+70.55;
    }
};
makePodzialki();

function makeCurrentDateLine(){
    let currenMonth=currentDate.getMonth();
    let currentDayCL=currentDate.getDate();
    var ktoryDivCL;
    if(currenMonth==0){
        ktoryDivCL='divStyczen';
    }else if(currenMonth==1){
        ktoryDivCL='divLuty';
    }else if(currenMonth==2){
        ktoryDivCL='divMarzec';
    }else if(currenMonth==3){
        ktoryDivCL='divKwiecien';
    }else if(currenMonth==4){
        ktoryDivCL='divMaj';
    }else if(currenMonth==5){
        ktoryDivCL='divCzerwiec';
    }else if(currenMonth==6){
        ktoryDivCL='divLipiec';
    }else if(currenMonth==7){
        ktoryDivCL='divSierpien';
    }else if(currenMonth==8){
        ktoryDivCL='divWrzesien';
    }else if(currenMonth==9){
        ktoryDivCL='divPazdziernik';
    }else if(currenMonth==10){
        ktoryDivCL='divListopad';
    }else if(currenMonth==11){
        ktoryDivCL='divGrudzien';
    };

    var divToWriteCL=document.getElementById(ktoryDivCL);
    var widthCL=10;
    var leftMarginCL=(currentDayCL-1)*10;
    divToWriteCL.innerHTML+="<style>#podzialkaCL{margin-left:"+leftMarginCL+"px; background-color: rgb(255, 70, 70); width: "+widthCL+"px; box-shadow: 0 0 0.1em 0.1em rgba(24, 23, 23, 0.500);}</style><div class='Podzialki' id='podzialkaCL'></div>";
   
};
makeCurrentDateLine();

function addTimeLines(){
    for (var i = 2; i < (tableTrLine.length); i++) {
        
        if(k<7){
            k+=1;
        }else{
            k=1;
        };
       
        var datedays = tableTrLine[i].getElementsByTagName("TD")[8];
        var DayMonth1 = tableTrLine[i].getElementsByTagName("TD")[1].innerHTML;
        var DayMonth2 = tableTrLine[i].getElementsByTagName("TD")[2].innerHTML;
        var dateAll1a = tableTrLine[i].getElementsByTagName("TD")[5].innerHTML;
        var dateAll1b=Date.parse(dateAll1a);
        var dateAll1=new Date(dateAll1b); 
        var day1a=dateAll1.getDate(); 
        var month1=DayMonth1.substr(3, 4);
        var month2=DayMonth2.substr(3, 4);
        var day1=day1a-1;
        var day1Scale=(day1)*10;
        var datedaysvalue = datedays.innerHTML;
        var days = (datedaysvalue*10);
        var ktoryDiv;

        if(month1==01){
            ktoryDiv='divStyczen';
        }else if(month1==02){
            ktoryDiv='divLuty';
        }else if(month1==03){
            ktoryDiv='divMarzec';
        }else if(month1==04){
            ktoryDiv='divKwiecien';
        }else if(month1==05){
            ktoryDiv='divMaj';
        }else if(month1==06){
            ktoryDiv='divCzerwiec';
        }else if(month1==07){
            ktoryDiv='divLipiec';
        }else if(month1==08){
            ktoryDiv='divSierpien';
        }else if(month1==09){
            ktoryDiv='divWrzesien';
        }else if(month1==10){
            ktoryDiv='divPazdziernik';
        }else if(month1==11){
            ktoryDiv='divListopad';
        }else if(month1==12){
            ktoryDiv='divGrudzien';
        };

        var divToWrite=document.getElementById(ktoryDiv);
        
        if(month2!==month1){
            divToWrite.innerHTML+="<style> #hr"+[i]+"{height: 16px;} #nriId"+[i]+"{margin-top: 10px;}</style>";
        };

        divToWrite.innerHTML+="<style> #hr"+[i]+"{width:"+days+"px; margin-left:"+day1Scale+"px;} </style> <div class='hrINr'><div class='boxhr'><hr id='hr"+[i]+"' class='hrColor"+[k]+"'> </div><div id='nriId"+[i]+"' class='nrHr'>"+[i-1]+"</div></div>";
        
    };
};
addTimeLines();