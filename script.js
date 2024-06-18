const dataContainer = document.getElementById('data-container');


fetch('https://jsonplaceholder.typicode.com/posts')
    .then(response => response.json())
    .then(data => {
        data.foreach(post => {
            const postElement = document.createElement('div');
        })
    })