//ZOOM SUR IMAGES
const images = document.querySelectorAll(".img-zoom");

for(var i=0;i<images.length;i++){
    images[i].addEventListener('mousemove', function(o){

        let width = this.offsetWidth;
        let height = this.offsetHeight;
        let mouseX = o.offsetX;
        let mouseY = o.offsetY;
    
        let imgPosX = (mouseX / width * 70);
        let imgPosY = (mouseY / height * 70);
    
        this.style.bottom = `${imgPosY}%`;
        this.style.right =`${imgPosX}%`;
    });

    images[i].addEventListener('mouseleave', function(o){
        this.style.bottom = `0px`;
        this.style.right =`0px`;
        this.style.width = "300px";
        this.style.height = "300px";
    });
};


// STOCK
//variables 
const pRestant = Array.from(document.querySelectorAll(".restant"));
const restant = pRestant.map(function(qte){return parseInt(qte.innerHTML);});
const nbCommande = Array.from(document.querySelectorAll(".nbCommande"));
const maCommande = Array.from(document.querySelectorAll(".scriptCommande"));
const stock = Array.from(document.querySelectorAll(".stock"));
const boutonPlus = Array.from(document.querySelectorAll(".plus"));
const boutonMoins = Array.from(document.querySelectorAll(".moins"));

//fonctions
const afficherStock = stock.map(function(o){
    o.addEventListener("click", function(e){
        e.preventDefault();
        maCommande[stock.indexOf(o)].classList.toggle("cache");;
    });
});

const ajouterQte = boutonPlus.map(function(o){
    o.addEventListener("click", function(e){
        e.preventDefault();
        let res = nbCommande[boutonPlus.indexOf(o)].innerHTML;
        let max = restant[boutonPlus.indexOf(o)];
        if(res < max){nbCommande[boutonPlus.indexOf(o)].innerHTML++;};
        if(res == 0){boutonMoins[boutonPlus.indexOf(o)].classList.remove("disabled");};
        if(res == max-1){boutonPlus[boutonPlus.indexOf(o)].classList.add("disabled");};
    });
});

const enleverQte = boutonMoins.map(function(o){
    o.addEventListener("click",function(e){
        e.preventDefault();
        let res = nbCommande[boutonMoins.indexOf(o)].innerHTML;
        if(0 < res){
            nbCommande[boutonMoins.indexOf(o)].innerHTML--;
            boutonPlus[boutonMoins.indexOf(o)].classList.remove("disabled");
        };
        if(res==1){boutonMoins[boutonMoins.indexOf(o)].classList.add("disabled");};
        });
});



