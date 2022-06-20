const showInfoWindow = document.querySelector('#infoView');
const infoButton = document.querySelector('#infoButton');
infoButton.addEventListener('click', showInfo);
const closeInfo = document.querySelector('#closeInfo');
closeInfo.addEventListener('click', closeInfoPage);


//Funzione di visualizzazione delle info


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