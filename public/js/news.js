const showInfoWindow = document.querySelector('#infoView');
const infoButton = document.querySelector('#infoButton');
infoButton.addEventListener('click', showInfo);
const closeInfo = document.querySelector('#closeInfo');
closeInfo.addEventListener('click', closeInfoPage);

function showInfo() {
    if (showInfoWindow.classList.contains('hidden')) {
        showInfoWindow.classList.remove('hidden');
        document.body.classList.add('overflow');
    }
}

function closeInfoPage() {
    if (!showInfoWindow.classList.contains('hidden')) {
        showInfoWindow.classList.add('hidden');
        document.body.classList.remove('overflow');
    }
}

function GetNews(){
    fetch(BASE_URL+'news/getnews').then(fetchResponse, onError).then(fetchPostsJson);
}

function fetchResponse(response) {
    console.log('Fetch dei post....');
    return response.json();
}

function onError(error) {
    console.log('Error' + error);
}

function fetchPostsJson(json) {
    console.log(json);
    const news = document.querySelector("#news");
    const results = json;
    let num_results = results.length;
    for (let i = 0; i < num_results; i++){
        const post = results[i];
        const sezione = document.createElement("div");
        const titolo = document.createElement("p");
        const immagine = document.createElement("img");
        immagine.src = post.image;
        immagine.classList.add("img");
        titolo.textContent = post.title;
        titolo.classList.add("titolo");
        const testo = document.createElement("p");
        testo.textContent = post.text;
        testo.classList.add("testo");
        const data = document.createElement("p");
        data.textContent = 'Pubblicato : ' + post.date;
        data.classList.add("data");
        sezione.appendChild(data);
        sezione.appendChild(titolo);
        sezione.appendChild(testo);
        sezione.appendChild(immagine);
        news.appendChild(sezione);
    }
}

GetNews ();