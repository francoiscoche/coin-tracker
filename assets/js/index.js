import axios from "axios";
import { Notyf } from 'notyf';
import 'notyf/notyf.min.css'; // for React, Vue and Svelte

function onClickBtnFav(event) {
    event.preventDefault(); // disabled automatic page reload behavior

    const url = this.href;
    const icon = this.querySelector('i');
    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'left',
            y: 'bottom'
        },
        ripple: false,
        dismissible: false
    });

    axios.get(url).then(function(response) {
        if(icon.classList.contains('fa')) {
            icon.classList.replace('fa', 'far');
            notyf.success('You\'re not following anymore this currency');
        } else {
            icon.classList.replace('far', 'fa');
            notyf.success('You\'re are now following this currency');
        }

    }).catch(function(error) {
        if(error.response.status === 403) notyf.error('You can\'t follow a currency if you\'re not log in');
        else notyf.error('Error');
    });
}

function onClickBtnLike(event) {
    event.preventDefault(); // disabled automatic page reload behavior

    const url = this.href;
    const icon = this.querySelector('i');
    const spanCount = this.querySelector('.js-likes');

    const notyf = new Notyf({
        duration: 3000,
        position: {
            x: 'left',
            y: 'bottom'
        },
        ripple: false,
        dismissible: false
    });

    axios.get(url).then(function(response) {
        spanCount.textContent = response.data.likes;
        if(icon.classList.contains('fa')) {
            icon.classList.replace('fa', 'far');
            notyf.success('Unlike');
        } else {
            icon.classList.replace('far', 'fa');
            notyf.success('Like');
        }

    }).catch(function(error) {
        if(error.response.status === 403) notyf.error('You can\'t like this article because you\'re not log in');
        else notyf.error('Error');
    });
}

document.querySelectorAll('a.js-link').forEach(function(link) {
    link.addEventListener('click', onClickBtnFav);
});

document.querySelectorAll('a.js-like').forEach(function(link) {
    link.addEventListener('click', onClickBtnLike);
});