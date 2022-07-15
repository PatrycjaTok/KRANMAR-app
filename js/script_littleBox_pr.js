function okienko1(){
    let width1=(screen.width-350)/2;
    let height1=(screen.height-500)/2;
    let height=500;
    let width=350;
    window.open("dodajPracownika.php", "Dodaj pracownika", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
};

function okienko2(){
    let width1=(screen.width-300)/2;
    let height1=(screen.height-250)/2;
    let height=250;
    let width=300;
    window.open("dodajFirme.php", "Dodaj firmę", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
};

function okienko3(){
    let width1=(screen.width-300)/2;
    let height1=(screen.height-300)/2;
    let height=300;
    let width=300;
    window.open("dodajrandomPeop.php", "Dodaj", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
};


function okienkoDelete(idPodm){
    let width1=(screen.width-400)/2;
    let height1=(screen.height-250)/2;
    let height=250;
    let width=400;
    window.open("deletePracownika.php?zmiennaId="+idPodm, "Usuń pracownika", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};

function okienkoDelete2(idPodm){
    let width1=(screen.width-400)/2;
    let height1=(screen.height-250)/2;
    let height=250;
    let width=400;
    window.open("deleteFirmy.php?zmiennaId="+idPodm, "Usuń firmę", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};

function okienkoDelete3(idPodm){
    var height=250;
    var width=400;

    var width1=(screen.width-width)/2;
    var height1=(screen.height-height)/2;
    window.open("deleterandomPeop.php?zmiennaId="+idPodm, "Usuń", "toolbar=no, menubar=no, location=no, personalbar=no, status=no, resizable=yes, scrollbars=yes, copyhistory=yes, width="+width+", height="+height+", top="+height1+", left="+width1);
    
};


