function fetchPosts() {
    fetch('post_liked').then(fetchResponse, onError).then(fetchPostsJson);
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
        const not_found = document.createElement("div");
        const text1 = document.createElement("p");
        text1.textContent = "Non hai messo like a nessun post!";
        text1.classList.add("notfound");
        not_found.appendChild(text1);
        posts.appendChild(not_found);
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



function onResponse(response) {
    console.log('Successo!');
    return response.json();
}


function LikePost(event) {
    event.preventDefault();
    const like_selected = event.currentTarget.dataset.postsid;
    console.log(like_selected);

    fetch('/likes/' + like_selected).then(onResponse, onError).then(onJSONResponseLike)

}

function onJSONResponseLike(json) {
    console.log(json);
    const like = document.querySelector("[data-postsid='" + json.postid + "']");
    console.log(like);
    if (json.like == true) {
        like.classList.remove('unliked');
        like.classList.add('liked');
    }
    else {
        like.classList.add('unliked');
        like.classList.remove('liked');
    }
}

function eliminaPost(event) {
    const id_post = event.currentTarget.dataset.postsidbin;
    //Itero tutti i div e li rimuovo dal DOM
    const posts_div = document.querySelectorAll('#posts div').forEach(function(element){
        element.remove();
    });
    // posts_div.innerHTML = ''; Non funzionante in quanto rimangono i div vuoti 
    fetch("/delete_post/" + id_post).then(onResponse, onError).then(fetchPostsJson);
    fetchPosts();


}