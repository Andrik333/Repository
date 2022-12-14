window.onload = function () {

    let form = document.querySelector('#registration-form');
    if (form) {
        form.addEventListener('submit', function(e){
            e.preventDefault();
            let pass = this.querySelector('input[name=password]');
            let passRep = this.querySelector('input[name=passwordRepeat]');

            if (pass.value == passRep.value) {
                this.submit();
            } else {
                showAlert({message: 'Пароли не совпадают'});
            }
        });
    }

    parseAndShowMessages();

};

let showAlert = (data) => {
    let alert = document.querySelector('#alert');
    let blockTitle = alert.querySelector('.title');
    let blockMsg = alert.querySelector('.message');

    data?.messgase ?? (data.messgase = 'Ошибка');
    data?.type ?? (data.type = 'error');
    data?.timeOutHide ?? (data.timeOutHide = 5000);

    switch (data.type) {
        case 'error':
            data.title = 'Ошибка';
            break;
    
        case 'complite':
            data.title = 'Успешно';
            break;
    }

    alert.classList = data.type + ' show';
    blockTitle.innerHTML = data.title;
    blockMsg.innerHTML = data.message;

    setTimeout(() => {
        alert.classList = '';
    }, data.timeOutHide);
}

let parseAndShowMessages = () => {
    let localData = JSON.parse(localStorage.getItem('messages')) ?? [];
    dataMessages.forEach(message => {
        localData.push(message);
    });

    for(let i = 0; i < localData.length; i++) {
        if (localData[i].url == window.location.pathname.replace(/^\/|\/$/gm, '')) {
            showAlert({message: localData[i].text, type: localData[i].type});
            localData.splice(i, 1);
        }
    };

    localStorage.setItem('messages', JSON.stringify(localData));
}

let redComments = () => {
    let texts = document.querySelectorAll('.comment-text');
    texts.forEach(text => {
        text.style.color = 'red';
    });
};

let removeComment = (elem) => {

    let data = JSON.parse(elem.dataset.comment);

    fetch('remove-comment?idNews='+data.news+'&idComment='+data.comment).then(response => response.json())
    .then(result => {
        if (result.status) {
            document.querySelector('.comments').remove();
            document.querySelector('.content').insertAdjacentHTML('beforeend', result.data);
            showAlert({message: result.message, type: 'complite'});
        } else {
            showAlert({message: result.message, type: 'error'});
        }
    });
}

let hideNews = () => {
    let autor = document.querySelector('input[name=autor]').value.trim();

    if (autor.length == 0) return;

    fetch('index-filter-news?autor='+autor).then(response => response.json())
    .then(result => {
        let wrapper = document.querySelector('.content')
        wrapper.innerHTML = '';
        wrapper.insertAdjacentHTML('beforeend', result.data);
        showAlert({message: result.message, type: 'complite'});
    });
}