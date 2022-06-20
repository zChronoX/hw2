
const userinfo = document.querySelector('#userinfo');
userinfo.addEventListener('click', info);
const profile = document.querySelector('#profile');

function info() {
    if (profile.classList.contains('hidden')) {
        profile.classList.remove('hidden');
    }
    else
        profile.classList.add('hidden');
}

function SpotifySearch(event) {
    event.preventDefault();

}


function fetchPosts() {
    fetch(BASE_URL+'post').then(fetchResponse, onError).then(fetchPostsJson);
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
    const posts = document.querySelector("#posts");
    if (json.length == 0){
        const text1 = document.createElement("p");
        text1.textContent = "Non ci sono post per ora!";
        text1.classList.add("notfound");
        posts.appendChild(text1);
    }
    const results = json;
    let num_results = results.length;
    if (num_results > 10)
        num_results = 10;
    for (let i = 0; i < num_results; i++) {
        const post = results[i];
        const number = document.createElement("div");
        const title = document.createElement("p");
        title.textContent = post.titolo;
        title.classList.add("titolo");
        const text = document.createElement("p");
        text.textContent = post.testo;
        text.classList.add("testo");
        const user = document.createElement("p");
        user.textContent = post.nome + " " + post.cognome;
        user.classList.add("user");
        const time = document.createElement("time");
        time.textContent = post.tempo;
        time.classList.add("time");
        const username = document.createElement("p");
        username.textContent = "@" + post.username;
        username.classList.add("username2");
        username.classList.add("userinfo");
        user.classList.add("userinfo");
        time.classList.add("userinfo");
        const elimina = document.createElement("a");
        elimina.href = '#';
        elimina.dataset.postsidbin = post.posts_id;
        elimina.textContent = "🗑️";
        elimina.addEventListener("click", eliminaPost);
        const like = document.createElement("a");
        like.href = '#';
        like.dataset.postsid = post.posts_id;
        like.textContent = "Like";
        like.classList.add("like");
        if (post.liked == 1) {
            like.classList.add("liked");
        }
        else {
            like.classList.add("unliked");
        }
        like.addEventListener("click", LikePost);
        number.appendChild(user);
        number.appendChild(username);
        number.appendChild(time);
        number.appendChild(title);
        number.appendChild(text);
        number.appendChild(elimina);
        number.appendChild(like);
        posts.appendChild(number);

    }



}

fetchPosts();


function LikePost(event) {
    event.preventDefault();
    const like_selected = event.currentTarget.dataset.postsid;

    fetch("/likes/"+ like_selected).then(onResponse, onError).then(onJSONResponseLikeAll);

}


function onJSONResponseLikeAll(json) {
    const like = document.querySelectorAll("[data-postsid='" + json.postid + "']");
    let i;
    if (json.like == true) {
        for (i = 0; i < like.length; i++) {
            like[i].classList.remove('unliked');
            like[i].classList.add('liked');
        }
    }
    else {
        for (i = 0; i < like.length; i++) {
            like[i].classList.add('unliked');
            like[i].classList.remove('liked');
        }
    }
}

function RicercaSpotify(event) {
    event.preventDefault();
    const input = document.querySelector('#track');
    const input_value = encodeURIComponent(input.value);
    console.log('Eseguo la ricerca di : ' + input_value);
    fetch(BASE_URL+'spotify' + "?&q=" + input_value).then(onResponse, onError).then(onJSONSpotify);
}


function onResponse(response) {
    console.log('Successo!');
    return response.json();
}

function onJSONSpotify(json) {
    console.log(json);
    const library = document.querySelector('#a1');
    library.innerHTML = '';
    if (json.error){
        const not_found = document.createElement("div");
        const text1 = document.createElement("p");
        text1.textContent = "Non hai inserito un testo";
        text1.classList.add("notfound");
        not_found.appendChild(text1);
        library.appendChild(not_found);
        return null;
    }
    else if (json.tracks.items.length == 0){
        const not_found = document.createElement("div");
        const text1 = document.createElement("p");
        text1.textContent = "Nessun brano trovato!";
        text1.classList.add("notfound");
        not_found.appendChild(text1);
        library.appendChild(not_found);
    }
    const results = json.tracks.items;
    let num_results = results.length;
    if (num_results > 3)
        num_results = 3;
    for (let i = 0; i < num_results; i++) {
        const album_data = results[i]
        const title = album_data.name;
        const url = album_data.uri;
        var site = document.createElement('a');
        site.setAttribute('href', url);
        site.textContent = 'Ascolta su Spotify';
        const selected_image = album_data.album.images[1].url;
        const album = document.createElement('div');
        album.classList.add('album');
        const img = document.createElement('img');
        img.src = selected_image;
        const caption = document.createElement('span');
        caption.textContent = 'Titolo: ' + title;
        const artist = album_data.artists[0].name;
        const artist_name = document.createElement('span');
        artist_name.textContent = 'Artista: ' + artist;
        album.appendChild(img);
        album.appendChild(caption);
        album.appendChild(artist_name);
        album.appendChild(site);
        library.appendChild(album);

    }
}


const f1 = document.forms['spotify'];
f1.addEventListener('submit', RicercaSpotify);

function eliminaPost(event) {
    const id_post = event.currentTarget.dataset.postsidbin;
    //Itero tutti i div e li rimuovo dal DOM
    const posts_div = document.querySelectorAll('#posts div').forEach(function(element){
        element.remove();
    });
    // posts_div.innerHTML = ''; Non funzionante in quanto rimangono i div vuoti 
    fetch("/delete_post/" + id_post).then(onDeleteResponse).then(onDeleteJson); //
    fetchPosts();
}

 function onDeleteResponse (response) {
    return response.json();
 }

 function onDeleteJson(json) {

    const error= document.querySelector(".errore");

    if(json["notauthorized"]){
        error.classList.remove("hidden");
    }
    else {
        error.classList.add("hidden");
    }
 }

const f2 = document.forms['search_posts'];
f2.addEventListener('submit', SearchPosts);

function onJSONSearch(json) {
    console.log(json);
    const posts = document.querySelector("#a2");
    posts.innerHTML = '';
    if (json.length == 0){
        const text1 = document.createElement("p");
        text1.textContent = "Nessun post trovato!";
        text1.classList.add("notfound");
        posts.appendChild(text1);
    }
    const results = json;
    posts.classList.remove("hidden");
    let num_results = results.length;
    if (num_results > 10)
        num_results = 10;
    for (let i = 0; i < num_results; i++) {
        const post = results[i];
        const number = document.createElement("div");
        const title = document.createElement("p");
        title.textContent = post.titolo;
        title.classList.add("titolo");
        const text = document.createElement("p");
        text.textContent = post.testo;
        text.classList.add("testo");
        const user = document.createElement("p");
        user.textContent = post.nome + " " + post.cognome;
        user.classList.add("user");
        const time = document.createElement("time");
        time.textContent = post.tempo;
        time.classList.add("time");
        const username = document.createElement("p");
        username.textContent = "@" + post.username;
        username.classList.add("username2");
        username.classList.add("userinfo");
        user.classList.add("userinfo");
        time.classList.add("userinfo");
        const elimina = document.createElement("a");
        elimina.href = '#';
        elimina.dataset.postsidbin = post.posts_id;
        elimina.textContent = "🗑️";
        elimina.addEventListener("click", eliminaPost);
        const like = document.createElement("a");
        like.href = '#';
        like.dataset.postsid = post.posts_id;
        like.textContent = "Like";
        like.classList.add("like");
        if (post.liked == 1) {
            like.classList.add("liked");
        }
        else {
            like.classList.add("unliked");
        }
        like.addEventListener("click", LikePost);
        number.appendChild(user);
        number.appendChild(username);
        number.appendChild(time);
        number.appendChild(title);
        number.appendChild(text);
        number.appendChild(elimina);
        number.appendChild(like);
        posts.appendChild(number);

    }

}


function SearchPosts(event) {
    event.preventDefault();
    const input = document.querySelector('#search_ps');
    const input_value = encodeURIComponent(input.value);
    const empty = document.querySelector('#a2');
    empty.innerHTML = "";
    if (input_value == 0) {
        console.log('Non hai inserito niente');
        empty.classList.remove("hidden");
        const text = document.createElement("p");
        text.textContent = "Inserisci qualcosa da cercare!";
        text.classList.add("notfound");
        empty.appendChild(text);
    }
    else {
        console.log('Eseguo la ricerca del post contente:' + input_value);
        //Non funziona per ora//
        fetch(BASE_URL+'search_post/' + input_value).then(onResponse, onError).then(onJSONSearch);
    }
}






