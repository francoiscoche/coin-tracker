import axios from "axios";

function onClickBtnLike(event) {
    event.preventDefault(); // disabled automatic page reload behavior

    const url = this.href;
    const icon = this.querySelector('i');

    axios.get(url).then(function(response) {
        if(icon.classList.contains('fa')) icon.classList.replace('fa', 'far');
        else icon.classList.replace('far', 'fa');
    }).catch(function(error) {
        if(error.response.status === 403) window.alert("you cant fav if your not log in");
        else window.alert("error");
    });
}

document.querySelectorAll('a.js-link').forEach(function(link) {
    link.addEventListener('click', onClickBtnLike);
});
