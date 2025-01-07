function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

let playbutton = document.querySelector('.playnow'),
    grille = document.querySelector('.grille');
    PopUp = document.querySelector('#fin');



function getRandomIntInclusive(min, max) {
    const minCeiled   = Math.ceil(min);
    const maxFloored  = Math.floor(max);
    return Math.floor(Math.random() * (maxFloored - minCeiled + 1) + minCeiled); // The maximum is inclusive and the minimum is inclusive
  }

function melange(liste){
    let longueur=liste.length-1;
    for(let i= 0; i<longueur; i++){
        for(let j= 0; i<longueur; i++){
            let hasard = getRandomIntInclusive(0,longueur),
                stockage = liste[hasard];
            liste[hasard] = liste[i+j];
            liste[i+j] = stockage;

        }
    }
    return liste
}

function getDifficulty(){
    let difficulte = document.querySelector('#difficulte').value;
    
    switch(difficulte){
        case "2":
            return [6,[1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13,14,14,15,15,16,16,17,17,18,18]];
            break;
        case "3":
            return [8,[1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13,14,14,15,15,16,16,17,17,18,18,19,19,20,20,21,
                21,22,22,23,23,24,24,25,25,26,26,27,27,28,28,29,29,30,30,31,31,32,32]];
            break;
        case "4":
            return [12,[1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8,9,9,10,10,11,11,12,12,13,13,14,14,15,15,16,16,17,17,18,18,19,19,20,20,21,
                21,22,22,23,23,24,24,25,25,26,26,27,27,28,28,29,29,30,30,31,31,32,32,33,33,34,34,35,35,36,36,37,37,38,38,
                39,39,40,40,41,41,42,42,43,43,44,44,45,45,46,46,47,47,48,48,49,49,50,50,51,51,52,52,53,53,54,54,55,55,56,
                56,57,57,58,58,59,59,60,60,61,61,62,62,63,63,64,64,65,65,66,66,67,67,68,68,69,69,70,70,71,71,72,72]];
            break;
        default:
            return [4,[1,1,2,2,3,3,4,4,5,5,6,6,7,7,8,8]];
    }
}

function getLife(nombre){
    switch(nombre){
        case 4:
            return [60000,10000];
            break;
        case 6:
            return [36,6];
            break;
        case 8:
            return [66,11];
            break;
        default:
            return [144,24];
    }
}

function gettheme(){
    let difficulte = document.querySelector('#theme').value;
    
    switch(difficulte){
        case "2":
            return'<link rel="stylesheet" href="/assets/memory/AmongUs/theme.css" />';
            break;
        case "3":
            return'<link rel="stylesheet" href="/assets/memory/Araignee/theme.css" />';
            break;
        case "4":
            return '<link rel="stylesheet" href="/assets/memory/Mechant/theme.css" />';
            break;
        case '5':
            return '<link rel="stylesheet" href="/assets/memory/Shrek/theme.css" />';
            break;
        case '1':
            return '<link rel="stylesheet" href="/assets/memory/Halloween/theme.css" />';
             break;
        default:
            return '<link rel="stylesheet" href="/assets/memory/Halloween/theme.css" />';
    }
}


function bestscore(){
    let Bestcore = document.querySelector('.bestscore'),
        best;

    var postData = {
        theme: document.querySelector('#theme').value,
        difficulte : document.querySelector('#difficulte').value
    };
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "/utils/bestscore.php", true);


    xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");


    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {

            var data = JSON.parse(xhr.responseText);
            best = data["bestscore"];
            Bestcore.innerText = best;

        }

    };
    xhr.send(JSON.stringify(postData));
}



function jeu() {
    chronoStart();

    let difficulte = getDifficulty(),
        nombre_difficulte = difficulte[0],
        liste_carte = difficulte[1],
        liste_melange,
        i = 0,
        k = 0,
        image = (difficulte * difficulte) / 2;

    liste_melange = melange(liste_carte);

    // Clear the tableau
    grille.innerHTML = '';
   



    do{
        let ligne = document.createElement('tr');
        grille.appendChild(ligne);
        for(let j=0; j<nombre_difficulte; j++){
            let colonne = document.createElement('td'),
                bouton = document.createElement('button');
                bouton.classList.add("carte");
                bouton.id = k;
                k++;
            colonne.appendChild(bouton)
            ligne.appendChild(colonne)
        }
        i++;

        } while (i<nombre_difficulte)
    return [liste_melange,nombre_difficulte]
}

function returntheme(){
    let url_theme;
    url_theme = gettheme();
    if(url_theme == undefined){
        document.head.insertAdjacentHTML('beforeend',
            '<link rel="stylesheet" href="/assets/memory/Halloween/theme.css" />');
    }
    else{
        document.head.insertAdjacentHTML('beforeend', url_theme);
    }
}

returntheme()

let liste_melange,
    tailleList,
    nombre_difficulte=0;
playbutton.addEventListener('click', function(event){
    jeu();
    returntheme();
    let besoin_jeu = jeu();
    liste_melange= besoin_jeu[0];
    tailleList = liste_melange.length;
    nombre_difficulte = getLife(besoin_jeu[1]);
    let BarredeVie = document.querySelector('.vie'),
        Vies = BarredeVie.children,
        Vie1= Vies[0],
        Vie2 = Vies[1],
        Vie3 = Vies[2];
    PopUp.className = "rien";
    Vie1.className = "coeurcomplet";
    Vie2.className = "coeurcomplet";
    Vie3.className = "coeurcomplet";
    nbrFaux=0;
    bestscore();
})



let nbrRetourne=0,
    cartes = [],
    nbrFaux=0;
grille.addEventListener('click', function(event) {
    let carte = event.target,
        id = carte.id;

    console.log(nombre_difficulte);
    if (nbrRetourne < tailleList && nbrFaux < nombre_difficulte[0]) {
        Lifesystem(nbrFaux);

        // Si on click sur une carte
        if (carte.classList.contains('carte')) {

            // Si la carte n'est pas déjà retournée
            if (!carte.classList.contains('button' + liste_melange[id])){
                if(cartes.length < 2) {
                    carte.classList.add('button' + liste_melange[id]);
                    cartes.push(carte);
                }
            }
            if(cartes.length==2 ) {

                if (cartes[0].className != cartes[1].className) {
                    let cartesTmp = cartes;
                    setTimeout(() => {
                        cartesTmp[0].className = "carte";
                        cartesTmp[1].className = "carte";
                        nbrFaux += 1;
                    }, 500);
                }else {
                    nbrRetourne += 2
                }
                cartes = [];

            }
        }

    } else {
        if(nbrRetourne >= tailleList){
            let difficulte = document.querySelector('#difficulte').value;
            let theme = document.querySelector('#theme').value;
            let time = chronoStop();
            PopUp.className = "gagne";
            cartes = [];
            nbrRetourne = 0;
            grille.innerHTML = '';

            fetch('/utils/score.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    time,
                    theme: document.querySelector('#theme').value,
                    difficulte : document.querySelector('#difficulte').value
                })
            })
            .then(response => response.json())
            .then(data => console.log(data))







            }
        else{
            PopUp.className = "perdu";
            let time = chronoStop();
            cartes = [];
            nbrFaux = 0;
            grille.innerHTML = '';

        }

    }
})

function Lifesystem(nombre){
    let BarredeVie = document.querySelector('.vie'),
        Vies = BarredeVie.children,
        Vie1= Vies[0],
        Vie2 = Vies[1] ,
        Vie3 = Vies[2] ;
    switch (nombre){
        case nombre_difficulte[1]*1:
            Vie3.className = "demicoeur";
            break;
        case nombre_difficulte[1]*2:
            Vie3.className = "coeurvide";
            break;
        case nombre_difficulte[1]*3:
            Vie2.className = "demicoeur";
            break;
        case nombre_difficulte[1]*4:
            Vie2.className = "coeurvide";
            break;
        case nombre_difficulte[1]*5:
            Vie1.className = "demicoeur";
            break;
        case nombre_difficulte[0]-1:
            Vie1.className = "coeurvide";
            break;
        default:

        }
}


